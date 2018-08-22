<?php

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."json");
}
else{
    $path = "";
    $files = scandir(getcwd()."/json");
}

$outtext  = "<!doctype html>\n<html>\n<body>\n<ul>\n";
$listtext = "";
foreach(array_reverse($files) as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "json"){
        $listtext .= $value.",";
        $timestamp = substr(substr($value,4),0,-4);
        if(isset($_GET['path'])){
            $outtext .= "\n<li><a href = \"/page/index.php?path=".$path."&json=".$path."json/json".$timestamp.".txt"."\">json".$timestamp.".txt</a></li>\n";
        }
        else{
            $outtext .= "\n<li><a href = \"/page/index.php?path=".$path."&json=json/json".$timestamp.".txt\">"."json".$timestamp.".txt</a></li>\n";                 
        }

    }
}

$outtext .= "\n</ul>\n</body>\n</html>";

$file = fopen($path."json/index.html","w");// create new file with this name
fwrite($file,$outtext); //write data to file
fclose($file);  //close file

$file = fopen($path."json/list.txt","w");// create new file with this name
fwrite($file,$listtext); //write data to file
fclose($file);  //close file

?>