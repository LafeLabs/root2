 <!doctype html>
<html>
<head>
    <title>Scroll Editor</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>

</head>
<body class="no-mathjax">
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>


<div id = "linkscroll">
    <a href = "index.php" id = "indexlink">index.php</a>
    <a href = "scrolleditor.php" id = "scrolleditlink">scrolleditor.php</a>

    <a href = "tree.php">tree.php</a>
    <a href = "editor.php">editor.php</a>

</div>

<div id="maineditor" contenteditable="true" spellcheck="true"></div>
<script>

path = document.getElementById("pathdiv").innerHTML;

if(path.length>1){
    currentFile = path + "latex/scroll.tex";
    document.getElementById("indexlink").href = "index.php?path=" + path;
    document.getElementById("scrolleditlink").href = "scrolleditor.php?path=" + path;

}
else{
    currentFile = "latex/scroll.tex";
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
editor.getSession().setMode("ace/mode/latex");
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
    bottom:60%;
    right:0%;
    left:77%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
    
}

#maineditor{
    position:absolute;
    left:5%;
    top:5em;
    bottom:10px;
    right:25%;
}



</style>

</body>
</html>