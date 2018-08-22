<?php

$path = $_POST['path'];
$name = $_POST['name'];

if(strlen($path) == 0){
    mkdir($name);
    mkdir($name."/"."html");
    mkdir($name."/"."pages");
    mkdir($name."/"."json");
    mkdir($name."/"."svg");
}
else{
    mkdir($path."/".$name);
    mkdir($path."/".$name."/"."html");
    mkdir($path."/".$name."/"."pages");
    mkdir($path."/".$name."/"."json");
    mkdir($path."/".$name."/"."svg");
}
    
$file = fopen($path.$name."/"."html/page.txt","w");// create new file with this name
if(strlen($path)==0){
    fwrite($file,"<a href = \"pageeditor.php?path=".$name."/\">pageeditor.php?path=".$name."/</a>"); //write data to file
}
else{
    fwrite($file,"<a href = \"pageeditor.php?path=".$path."/".$name."\">pageeditor.php?path=".$path."/".$name."/</a>"); //write data to file    
}

fclose($file);  //close file

?>