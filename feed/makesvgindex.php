<?php

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."svg");
}
else{
    $path = "";
    $files = scandir(getcwd()."/svg");
}

$outtext  = "";
$listtext = "";

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,0,3) == "svg"){
        $listtext .= $value.",";
        $outtext .= "\n<p><img src = \"".$value."\"/></p>\n";
    }
}


$file = fopen($path."svg/index.html","w");// create new file with this name
fwrite($file,$outtext); //write data to file
fclose($file);  //close file


$file = fopen($path."svg/list.txt","w");// create new file with this name
fwrite($file,$listtext); //write data to file
fclose($file);  //close file

?>