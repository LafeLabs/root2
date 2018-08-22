<?php
function listfiles($localpath){
    $fullpath = getcwd()."/../curve".$localpath;
    $files = scandir($fullpath);
    foreach($files as $filename){
        if($filename != "javascript" && $filename != "bytecode" && $filename != "svg" && $filename != "json" && $filename != "css" && $filename != "tables" && $filename != "php" && $filename != "html" && $filename != "." && $filename != ".." && is_dir($fullpath."/".$filename)){
            
           $fileandpath = substr($localpath,1)."/".$filename;
           if($fileandpath[0] == "/"){
               $fileandpath = substr($fileandpath,1);
           } 
           echo  "../curve".$localpath."/".$filename."/\n";
           $nextpath = $localpath."/".$filename;                
           listfiles($nextpath);
        }
    }
}


listfiles("");

?>