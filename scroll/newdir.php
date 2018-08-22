<?php

$path = $_POST['path'];
$name = $_POST['name'];

if(strlen($path) == 0){
    mkdir($name);
    mkdir($name."/"."html");
    mkdir($name."/"."scrolls");
    mkdir($name."/"."latex");
    mkdir($name."/"."jupyter");
    mkdir($name."/"."figures");

    
}
else{
    mkdir($path."/".$name);
    mkdir($path."/".$name."/"."html");
    mkdir($path."/".$name."/"."scrolls");
    mkdir($path."/".$name."/"."latex");
    mkdir($path."/".$name."/"."jupyter");
    mkdir($path."/".$name."/"."figures");
    
}
    
$file = fopen($path."/".$name."/"."html/scroll.txt","w");// create new file with this name
fwrite($file,"new wall"); //write data to file
fclose($file);  //close file

?>