<?php

function getfiles($localpath){
    $outstring = "";
    $files = scandir(getcwd()."/".$localpath);
    $outstring .= "\t{\n\t\t\"path\":\"".$localpath."\",\n\t\t\"files\":[\n";
    
    foreach($files as $value){
        if($value != "." && $value != ".."){
            if(substr($value,-4) == ".txt"){
                $outstring .= "\t\t\t\"".$value."\",\n";
            }
        }
    }
    $outstring = substr($outstring,0,-2);
    $outstring .= "\n\t\t]\n\t}";
    return $outstring;
}


$finalstring = "[\n";

$finalstring .= getfiles("php");
$finalstring .= ",\n";
$finalstring .= getfiles("html");
$finalstring .= ",\n";
$finalstring .= getfiles("json");
$finalstring .= ",\n";

$finalstring .= getfiles("page/php");
$finalstring .= ",\n";
$finalstring .= getfiles("page/html");
$finalstring .= ",\n";

$finalstring .= getfiles("feed/php");
$finalstring .= ",\n";
$finalstring .= getfiles("feed/html");
$finalstring .= ",\n";

$finalstring .= getfiles("scroll/php");
$finalstring .= ",\n";
$finalstring .= getfiles("scroll/html");
$finalstring .= ",\n";

$finalstring .= getfiles("symbol/php");
$finalstring .= ",\n";
$finalstring .= getfiles("symbol/html");
$finalstring .= ",\n";
$finalstring .= getfiles("symbol/css");
$finalstring .= ",\n";
$finalstring .= getfiles("symbol/javascript");
$finalstring .= ",\n";
$finalstring .= getfiles("symbol/bytecode");
$finalstring .= ",\n";
$finalstring .= getfiles("symbol/json");
$finalstring .= ",\n";

$finalstring .= getfiles("deck/php");
$finalstring .= ",\n";
$finalstring .= getfiles("deck/html");
$finalstring .= ",\n";
$finalstring .= getfiles("deck/javascript");
$finalstring .= ",\n";
$finalstring .= getfiles("deck/bytecode");
$finalstring .= ",\n";
$finalstring .= getfiles("deck/json");
$finalstring .= ",\n";

$finalstring .= getfiles("curve/javascript");
$finalstring .= ",\n";
$finalstring .= getfiles("curve/html");
$finalstring .= ",\n";
$finalstring .= getfiles("curve/css");
$finalstring .= ",\n";
$finalstring .= getfiles("curve/json");
$finalstring .= ",\n";
$finalstring .= getfiles("curve/php");
$finalstring .= ",\n";

$finalstring .= getfiles("map/php");
$finalstring .= ",\n";
$finalstring .= getfiles("map/html");
$finalstring .= ",\n";
$finalstring .= getfiles("map/css");
$finalstring .= ",\n";
$finalstring .= getfiles("map/javascript");
$finalstring .= ",\n";
$finalstring .= getfiles("map/bytecode");
$finalstring .= ",\n";
$finalstring .= getfiles("map/json");

$finalstring .= "\n]";

echo $finalstring;

$file = fopen("json/dna.txt","w");// create new file with this name
fwrite($file,$finalstring); //write data to file
fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>