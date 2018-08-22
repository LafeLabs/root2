<?php

$path = $_POST['path'];
$name = $_POST['name'];

$jsontemplate = file_get_contents("json/currentjson.txt");
$stylejson = file_get_contents("json/stylejson.txt");

if(strlen($path) == 0){
    mkdir($name);
    mkdir($name."/"."bytecode");
    mkdir($name."/"."json");
    mkdir($name."/"."svg");

}
else{
    mkdir($path."/".$name);
    mkdir($path."/".$name."/"."bytecode");
    mkdir($path."/".$name."/"."json");
    mkdir($path."/".$name."/"."svg");
}
    
if(strlen($path) == 0){
    $file = fopen($name."/"."json/currentjson.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/currentjson.txt","w");// create new file with this name
}
fwrite($file,$jsontemplate); //write data to file
fclose($file);  //close file

if(strlen($path) == 0){
    $file = fopen($name."/"."json/stylejson.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/stylejson.txt","w");// create new file with this name
}
fwrite($file,$stylejson); //write data to file
fclose($file);  //close file


?>