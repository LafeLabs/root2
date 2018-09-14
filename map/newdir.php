<?php

$path = $_POST['path'];
$name = $_POST['name'];

if(strlen($path) == 0){
    mkdir($name);
    mkdir($name."/"."json");
}
else{
    mkdir($path."/".$name);
    mkdir($path."/".$name."/"."json");
}

$viewtemplate = file_get_contents("json/view.txt");
$settemplate = file_get_contents("json/set.txt");
$maptemplate = file_get_contents("json/map.txt");


if(strlen($path) == 0){
    $file = fopen($name."/"."json/view.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/view.txt","w");// create new file with this name
}
fwrite($file,$viewtemplate); //write data to file
fclose($file);  //close file

if(strlen($path) == 0){
    $file = fopen($name."/"."json/set.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/set.txt");// create new file with this name
}
fwrite($file,$settemplate); //write data to file
fclose($file);  //close file
if(strlen($path) == 0){
    $file = fopen($name."/"."json/map.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/map.txt","w");// create new file with this name
}
fwrite($file,$maptemplate); //write data to file
fclose($file);  //close file
    
?>