 <!doctype html>
<html>
<head>
    <!--
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

ALL CODE IS PUBLIC DOMAIN NO PATENTS NO COPYRIGHTS
-->
    
    <!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div style = "display:none" id = "datadiv"><?php

    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']."/json/stylejson.txt");
    }
    else{
        echo file_get_contents("json/stylejson.txt");
    }

?></div>    
<div id = "linkscroll">

    <a href = "tree.php">tree.php</a>
    <a href = "editor.php">editor.php</a>
    <a href = "index.php" id = "indexlink">index.php</a>

</div>
<div id = "namediv">stylejson.txt</div>
<div id="maineditor" contenteditable="true" spellcheck="false"></div>


<script>

editor = ace.edit("maineditor");
editor.setTheme("ace/theme/cobalt");
editor.getSession().setMode("ace/mode/json");
editor.getSession().setUseWrapMode(true);
editor.$blockScrolling = Infinity;

path = document.getElementById("pathdiv").innerHTML;

if(path.length>1){
    currentFile = path + "json/stylejson.txt";
    document.getElementById("indexlink").href = "index.php?path=" + path;
}
else{
    currentFile = "json/stylejson.txt";
}

var httpc = new XMLHttpRequest();
httpc.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        filedata = this.responseText;
        editor.setValue(filedata);
    }
};
httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
httpc.send();

editor.getSession().setMode("ace/mode/json");
document.getElementById("namediv").style.color = "orange";
document.getElementById("namediv").style.borderColor = "orange";
            
            

document.getElementById("maineditor").onkeyup = function(){
    data = encodeURIComponent(editor.getSession().getValue());
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}

</script>
<style>
#namediv{
    position:absolute;
    top:5px;
    left:20%;
    font-family:courier;
    padding:0.5em 0.5em 0.5em 0.5em;
    border:solid;
    background-color:#101010;

}
a{
    color:white;
    display:block;
    margin-bottom:0.5em;
    margin-left:0.5em;
}
body{
    background-color:#404040;
}
.html{
    color:#0000ff;
}


#linkscroll{
    position:absolute;
    overflow:scroll;
    top:5em;
    bottom:50%;
    right:0px;
    left:75%;
    border:solid;
    border-radius:5px;
    border-width:3px;
    background-color:#101010;
    font-family:courier;
    font-size:18px;
    
}
#maineditor{
    position:absolute;
    left:0%;
    top:5em;
    bottom:1em;
    right:30%;
}



</style>

</body>
</html>