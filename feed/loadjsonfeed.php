<?php
$jsondir = $_REQUEST["jsondir"];//get url
$jsonlist = explode(",",file_get_contents($jsondir."list.txt"));
$index = 0;

echo "[";
foreach($jsonlist as $value){
  if($value != null && strlen($value) > 3 && $index < count($jsonlist) - 2){
      echo file_get_contents($jsondir.$value).",";
  }  
  else{
      if($value != null && strlen($value) > 3){
          echo file_get_contents($jsondir.$value);
      }
  }
  $index += 1;
}
echo "]";

?>