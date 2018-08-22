<?php
$htmldir = $_REQUEST["htmldir"];//get url
$htmllist = explode(",",file_get_contents($htmldir."list.txt"));
$index = 0;

foreach($htmllist as $value){
  if($value != null && strlen($value) > 3 && $index < count($jsonlist) - 2){
      echo "<feedbox>";
      echo file_get_contents($htmldir.$value).",";
      echo "</feedbox>";
  }  
  else{
      if($value != null && strlen($value) > 3){
          echo "<feedbox>";
          echo file_get_contents($htmldir.$value);
          echo "</feedbox>";
      }
  }
  $index += 1;
}

?>