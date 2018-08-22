 <!doctype html>
<html>
<head>
    <title>Scroll Editor</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
   <script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>
</head>
<body class="no-mathjax">
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>

<div id = "scrolldisplay"  class = "mathjax"></div>

<div id = "linkscroll">
    <a href = "index.php" id = "indexlink">index.php</a>
    <a href = "figurelist.php" id = "figurelink">figurelist.php</a>
    <a href = "scrolls/index.html" id = "scrollslink">scrolls/index.html</a>
    <a href = "texeditor.php" id = "texlink">texeditor.php</a>
    <a href = "jupyter.php" id = "jupyterlink">jupyter.php</a>

    <a href = "tree.php">tree.php</a>
    <a href = "editor.php">editor.php</a>


    <div class = "button">FIGURE</div>
    <div class = "button">HTML2TEX</div>
    <div class = "button">SAVE</div>

</div>

<div id="maineditor" contenteditable="true" spellcheck="true"></div>
<textarea id = "texbox"></textarea>
<script>

path = document.getElementById("pathdiv").innerHTML;

if(path.length>1){
    currentFile = path + "html/scroll.txt";
    texFile = path + "latex/scroll.tex";

    document.getElementById("indexlink").href = "index.php?path=" + path;
    document.getElementById("texlink").href = "texeditor.php?path=" + path;
    document.getElementById("figurelink").href = "figurelist.php?path=" + path;
    document.getElementById("scrollslink").href = path + "scrolls/index.html";
    
    document.getElementById("jupyterlink").href = "jupyter.php?path=" + path;;

}
else{
    currentFile = "html/scroll.txt";
    texFile = "latex/scroll.tex";
}

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
        html2tex();
        document.getElementById("scrolldisplay").innerHTML = filedata;
        MathJax.Hub.Typeset();//tell Mathjax to update the math
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();



editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/html");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php

    document.getElementById("scrolldisplay").innerHTML = editor.getSession().getValue();
    MathJax.Hub.Typeset();//tell Mathjax to update the math

}


buttons = document.getElementsByClassName("button");

buttons[0].onclick = function(){
    var figtext = "<figure>\n<img src = \"\"/><!--img-->\n<figcaption>Figure x. </figcaption>\n</figure>\n";
        var cursorPosition = editor.getCursorPosition();
        editor.getSession().insert(cursorPosition,figtext);
}
buttons[1].onclick = function(){


    html2tex();    
    //save this file to latex subdirectory
    
    data = encodeURIComponent(document.getElementById("texbox").value);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+texFile);//send text to filesaver.php
    
}

buttons[2].onclick = function(){
    //save scroll
    var httpc = new XMLHttpRequest();
    var url = "feedsaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    if(path.length>1){
        httpc.send("data=" + encodeURIComponent(editor.getSession().getValue()) + "&path=" + path);//send text to feedsaver.php

    }
    else{
        httpc.send("data=" + encodeURIComponent(editor.getSession().getValue()));//send text to feedsaver.php
    }

}


function html2tex(){
        var textin = editor.getSession().getValue();
    textout = "\n\\documentclass[11pt]{article}\n\\usepackage{graphicx}\n\\begin{document}\n";
    textout += textin;
    textout = textout.replace(/<p>/g,"\n\n");
    textout = textout.replace(/<\/p>/g,"");
    textout = textout.replace(/<h2>/g,"\n\\section{\n");
    textout = textout.replace(/<\/h2>/g,"}");
    textout = textout.replace(/<figure>/g,"\n\\begin{figure}");
    textout = textout.replace(/<\/figure>/g,"\\end{figure}\n");
    textout = textout.replace(/<figcaption>/g,"\\caption{");
    textout = textout.replace(/<\/figcaption>/g,"\}");
    if(path.length>1){
        var replace = "<img src = \"" + path;
        var re = new RegExp(replace,"g");
        textout = textout.replace(re,"\n\\includegraphics[width=\\linewidth]{../");
    }
    else{
        textout = textout.replace(/<img src = "/g,"\n\\includegraphics[width=\\linewidth]{../");
    }
    textout = textout.replace(/"\/><!--img-->/g,"\}\n");
    textout = textout.replace(/<li>/g,"\\item\n");
    textout = textout.replace(/<\/li>/g,"");
    textout = textout.replace(/<ul>/g,"\\begin{itemize}\n");
    textout = textout.replace(/<\/ul>/g,"\\end{itemize}");

    textout = textout.replace(/<ol>/g,"\\begin{enumerate}\n");
    textout = textout.replace(/<\/ol>/g,"\\end{enumerate}");

    textout = textout.replace(/<em>/g,"\\textit{\n");
    textout = textout.replace(/<\/em>/g,"}");
    
    
    textout+= "\n\\end{document}\n";
    document.getElementById("texbox").value = textout;
}
</script>
<style>
a{
    color:white;
    display:block;
    margin-bottom:0.5em;
    margin-left:0.5em;
}
body{
    background-color:#404040;
}


#linkscroll{
    position:absolute;
    overflow:scroll;
    top:0%;
    bottom:50%;
    right:0%;
    left:77%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
    
}
#texbox{
    position:absolute;
    right:0%;
    height:40%;
    bottom:0px;
    width:23%;
    font-family:courier;
    font-size:18px;
    display:block;
}
#maineditor{
    position:absolute;
    left:41%;
    top:5em;
    bottom:10px;
    right:25%;
}
#scrolldisplay{
    position:absolute;
    background-color:white;
    overflow:scroll;
    color:black;
    left:10px;
    bottom:10px;
    right:60%;
    top:5em;
    border:solid;
    border-width:3px;
    border-radius:0.5em;
    padding:1.5em 1.5em 1.5em 1.5em;
    font-family: Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif;
}
#scrolldisplay p,li,pre{
    width:80%;
    display:block;
    margin:auto;
    text-align:justify;    
    margin-bottom:1em;
    font-family: Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif;

}
#scrolldisplay h1,h2,h3{
    text-align:center;
}
#scrolldisplay a{
    color:blue;
    display:inline;

}
#scrolldisplay table{
    border-collapse:collapse;
    margin:auto;
    width:auto;
}
#scrolldisplay td{
    border:solid;
}
figure img{
    width:100%;
}
figure{
    width:80%;
}
figure figcaption{
    width:100%;
}
.button{
    color:yellow;
    cursor:pointer;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    border-color:yellow;
    border-radius:0.5em;
    margin-bottom:1em;
    margin-left:0.5em;
    margin-top:1em;
    display:block;
    margin:auto;
    text-align:center;
    width:80%;
}
.button:hover{
    background-color:#003000;
}   
.button:active{
    background-color:#304000;
}


</style>

</body>
</html>