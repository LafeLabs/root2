<?php

$finalstring = "[\n";

$basefiles = scandir(getcwd());

foreach($basefiles as $value){
    if($value != "javascript" && $value != "css" && $value != "bytecode" && $value != "html" && $value != "svg" && $value != "memes" && $value != "json" && $value != "php" && $value != "." && $value != ".." && is_dir($value)){
                $finalstring .= "\"".$value."\",";
    }
}

$finalstring = rtrim($finalstring, ",");
$finalstring .= "\n]";

echo $finalstring;

$file = fopen("json/treedna.txt","w");// create new file with this name
fwrite($file,$finalstring); //write data to file
fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>