<?php
$memedir = $_REQUEST["memedir"];//get url
$memelist = explode(",",file_get_contents($memedir."list.txt"));

foreach($memelist as $value){
    echo "\n".file_get_contents($memedir.$value)."\n";
}

?>