<?php

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."html");
}
else{
    $path = "";
    $files = scandir(getcwd()."/html");
}

$outtext  = "";
$listtext = "";

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "html"){
        $listtext .= $value.",";
        $outtext .= "\n<p><a href = \"".$value."\"/>".$value."</a></p>\n";
    }
}


$file = fopen($path."html/index.html","w");// create new file with this name
fwrite($file,$outtext); //write data to file
fclose($file);  //close file


$file = fopen($path."html/list.txt","w");// create new file with this name
fwrite($file,$listtext); //write data to file
fclose($file);  //close file

?>