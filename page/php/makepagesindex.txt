<?php

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."pages");
}
else{
    $path = "";
    $files = scandir(getcwd()."/pages");
}

$outtext  = "<!doctype html>\n<html>\n<body>\n";

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "page"){
        $timestamp = substr(substr($value,4),0,-4);
        $outtext .= "\n<p><a href = \"page".$timestamp.".txt\">".gmdate("Y-m-d H:i:s", $timestamp).": page".$timestamp.".txt</a></p>\n";     
    }
}

$outtext .= "\n</body>\n</html>";

$file = fopen($path."pages/index.html","w");// create new file with this name
fwrite($file,$outtext); //write data to file
fclose($file);  //close file


?>