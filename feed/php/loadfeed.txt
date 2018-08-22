<?php
/*


*/

if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."/feeds");
}
else{
    $path = "";
    $files = scandir(getcwd()."/feeds");
}

$latesttime = 0;

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "feed"){
     //   echo $value."<br/>".substr(substr($value,4),0,-4)."<br/>";
        $timestamp = substr(substr($value,4),0,-4);
     //   echo gmdate("Y-m-d H:i:s", $timestamp)."<br/>";     
     //   echo intval($timestamp) - 4287;
     //   echo "<br/>";
        if($timestamp > $latesttime){
            $latesttime = $timestamp;
        }
    }
}

if(isset($_GET['path'])){
    $latestfilename = $path."/feeds/feed".$latesttime.".txt";
}
else{
    $latestfilename = "feeds/feed".$latesttime.".txt";
}

echo file_get_contents($latestfilename);

?>