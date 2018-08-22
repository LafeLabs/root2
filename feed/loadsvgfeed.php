<?php
$svgdir = $_REQUEST["svgdir"];//get url
$svglist = explode(",",file_get_contents($svgdir."list.txt"));
$index = 0;

foreach($svglist as $value){
  echo $value.",";
}


?>