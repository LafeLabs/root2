<?php

$path = $_POST['path'];
$name = $_POST['name'];

if(strlen($path) == 0){
    mkdir($name);
    mkdir($name."/"."html");
    mkdir($name."/"."svg");
    mkdir($name."/"."json");
    mkdir($name."/"."javascript");
}
else{
    mkdir($path."/".$name);
    mkdir($path."/".$name."/"."html");
    mkdir($path."/".$name."/"."svg");
    mkdir($path."/".$name."/"."json");
    mkdir($path."/".$name."/"."javascript");
}

$equationtemplate = file_get_contents("html/equation.txt");
$functionstemplate = file_get_contents("javascript/topfunctions.txt");
$jsontemplate = file_get_contents("json/currentjson.txt");
$datatemplate = file_get_contents("json/plotdata.txt");


if(strlen($path) == 0){
    $file = fopen($name."/"."html/equation.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."html/equation.txt","w");// create new file with this name
}
fwrite($file,$equationtemplate); //write data to file
fclose($file);  //close file

if(strlen($path) == 0){
    $file = fopen($name."/"."javascript/topfunctions.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."javascript/topfunctions.txt","w");// create new file with this name
}
fwrite($file,$functionstemplate); //write data to file
fclose($file);  //close file

if(strlen($path) == 0){
    $file = fopen($name."/"."json/currentjson.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/currentjson.txt","w");// create new file with this name
}
fwrite($file,$jsontemplate); //write data to file
fclose($file);  //close file

if(strlen($path) == 0){
    $file = fopen($name."/"."json/plotdata.txt","w");// create new file with this name
}
else{
    $file = fopen($path."/".$name."/"."json/plotdata.txt","w");// create new file with this name
}
fwrite($file,$datatemplate); //write data to file
fclose($file);  //close file

    
?>