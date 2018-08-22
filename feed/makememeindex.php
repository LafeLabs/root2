<?php

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."memes");
}
else{
    $path = "";
    $files = scandir(getcwd()."/memes");
}

$outtext  = "";
$listtext = "";

foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "meme"){
        $listtext .= $value.",";
        $outtext .= "\n<p><a href = \"".$value."\"/>".$value."</a></p>\n";
    }
}


$file = fopen($path."memes/index.html","w");// create new file with this name
fwrite($file,$outtext); //write data to file
fclose($file);  //close file


$file = fopen($path."memes/list.txt","w");// create new file with this name
fwrite($file,$listtext); //write data to file
fclose($file);  //close file

?>