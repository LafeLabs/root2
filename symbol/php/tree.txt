<!doctype html>
<html>
<head>
<title>Tree</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<table>
    <tr>
        <td>Action:</td>
        <td>
            <input id = "actioninput"/>
        </td>
        <td>path:</td>
        <td>
            <input id = "pathinput"/>
        </td>
        <td>filename:</td>
        <td>
            <input id = "nameinput"/>
        </td>
        <td class = "button" id = "newbutton">CREATE NEW</td>
    </tr>
</table>


<?php
function listfiles($localpath){
    $fullpath = getcwd().$localpath;
    $files = scandir($fullpath);
    foreach($files as $filename){
        if($filename != "tables" && $filename != "svg" && $filename != "json" && $filename != "javascript" && $filename != "css" && $filename != "bytecode" && $filename != "php" && $filename != "html" && $filename != "." && $filename != ".." && is_dir($fullpath."/".$filename)){
            
           $fileandpath = substr($localpath,1)."/".$filename;
           if($fileandpath[0] == "/"){
               $fileandpath = substr($fileandpath,1);
           } 
           echo  "\n<li><a href = \"index.php?path=".$fileandpath."/\">".$fileandpath."/</a></li>\n";
               $nextpath = $localpath."/".$filename;                
            echo "<ul>";
           listfiles($nextpath);
            echo "</ul>";
        }
    }
}


echo "<ul>\n";

listfiles("");

echo "</ul>\n";

?>

<p><a href = "../">../</a></p>
<p><a href = "index.php">index.php</a></p>
<p><a href = "editor.php">editor.php</a></p>
<p><a href = "shapetableeditor.php">shapetableeditor.php</a></p>
<p><a href = "keybaordeditor.php">keybaordeditor.php</a></p>

<script>
    lindex = 0;
    lis = document.getElementsByTagName("LI");
    if(lis.length > 0){
        redraw();
    }

    function redraw(){
            lis[lindex].style.backgroundColor = "pink";
            path =  lis[lindex].getElementsByTagName("A")[0].innerHTML;
            document.getElementById("pathinput").value = path;
    }
    document.getElementById("actioninput").onkeydown = function(a){
        if(a.key == "ArrowDown"){
            lis[lindex].style.backgroundColor = "white";
            lindex++;
            if(lindex > lis.length-1){
                lindex = 0;
            }
            redraw();

        }
        if(a.key == "ArrowUp"){
            lis[lindex].style.backgroundColor = "white";
            lindex--;
            if(lindex < 0){
                lindex = lis.length-1;
            }
            redraw();
        }
    }
    
    document.getElementById("actioninput").select();

    document.getElementById("newbutton").onclick = function(){
        name = document.getElementById("nameinput").value;
        path = document.getElementById("pathinput").value;
        if(name.length>1){
            console.log("path=" + path + ",name=" + name);
            var httpc = new XMLHttpRequest();
            var url = "newdir.php";        
            httpc.open("POST", url, true);
            httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc.send("path="+path+"&name="+name);//send text to newdir.php            
        }

    }
</script>
<style>
    body{
        font-size:2em;
        background-color:white;
        font-family:Helvetica;
    }
    ul ul{
        font-size:0.5em;
        margin-left:6em;
    }
    #actioninput{
        width:1em;
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