 <!doctype html>
<html>
<head>
 <!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!-- links to MathJax JavaScript library, un-comment to use math-->
<!--

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

-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
<title>Page Editor</title>
</head>
<body  class="no-mathjax">
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<table id = "linktable">
    <tr>
        <td>
            <a href = "index.php" id = "indexlink">index.php</a>
        </td>
        <td>
            <a href = "editor.php">editor.php</a>
        </td>
        <td>
            <a href = "tree.php">tree.php</a>
        </td>
        <td class = "button" id = "savebutton">
            SAVE FEED
        </td>
        <td class = "button" id = "loadbutton">
            LOAD MOST RECENT FEED
        </td>
        <td>
            <a href = "feeds/" id = "pageslink">feeds/</a>
        </td>
    </tr>
</table>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>
<script>
pathset = false;

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

    //un-comment this for math:
    //MathJax.Hub.Typeset();//tell Mathjax to update the math
}

//all of the light you see on the Moon is reflected from the Sun
if(document.getElementById("pathdiv").innerHTML.length > 1){
    pathset = true;
    path = document.getElementById("pathdiv").innerHTML;
    currentFile = path + "/html/feed.txt";
    document.getElementById("indexlink").href = "index.php?path=" + path;
    document.getElementById("indexlink").innerHTML = "index.php?path=" + path;
    
    document.getElementById("pageslink").href = path + "feeds";
    currentFile = path + "html/feed.txt";
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            editor.setValue(filedata);
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();

}
else{
    currentFile = "html/feed.txt";
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            editor.setValue(filedata);
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}

document.getElementById("savebutton").onclick = function(){

    timestamp = Math.round((new Date().getTime())/1000);
    if(pathset){
        archiveFile = path + "/feeds/feed" + timestamp + ".txt";
        indexFile = path + "index.html";
    }
    else{
        archiveFile = "feeds/feed" + timestamp + ".txt";
    }
    
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+archiveFile);//send text to filesaver.php
    if(pathset){
        data = encodeURIComponent(editor.getSession().getValue());
        data = "<!doctype html>\n<html>\n<body>\n" + data + "\n</body>\n</html>";
        var httpc = new XMLHttpRequest();
        var url = "filesaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("data="+data+"&filename=" + indexFile);//send text to filesaver.php 
    }
    
    var httpc = new XMLHttpRequest();
    if(pathset){
        var url = "makepagesindex.php?path=" + path;        
    }
    else{
        var url = "makepagesindex.php";        
    }
    httpc.open("GET", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send();//send text to filesaver.php
}

document.getElementById("loadbutton").onclick = function(){
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            editor.setValue(filedata);
            var httpc2 = new XMLHttpRequest();
            var url = "filesaver.php";        
            httpc2.open("POST", url, true);
            httpc2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc2.send("data="+filedata+"&filename="+currentFile);//send text to filesaver.php
        }
    };
    if(pathset){
        httpc.open("GET", "loadpage.php?path=" + path, true);
    }
    else{
        httpc.open("GET", "loadpage.php", true);
    }
    httpc.send();

}

</script>
<style>
body{
    background-color:#404040;
    font-family:Helvetica;
}
#maineditor{
    position:absolute;
    top:4em;
    bottom:5px;
    right:5px;
    left:5px;
    font-size:22px;
}

#linktable{
    position:absolute;
    top:0px;
    left:0px;
    font-size:22px;
}
#linktable a{
    color:white;
}
#linktable td{
    padding-left:2em;
}
.button{
    cursor:pointer;
    text-align:center;
    background-color:white;
    border-radius:0.5em;
    padding-left:2em;
    padding-right:2em;
    color:black;
    z-index:2;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}

</style>

</body>
</html>