<!doctype html>
<html>
<head>
<title>Feed</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!-- links to MathJax JavaScript library, un-comment to use math-->
<!--

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>

-->
</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "jsondata" style = "display:none;"><?php

if(isset($_GET['json'])){
    $jsonurl = $_GET['json'];
}
if(!isset($_GET['json']) && isset($_GET['path'])){
    $jsonurl = $_GET['path']."json/";
}
if(!isset($_GET['json']) && !isset($_GET['path'])){
    $jsonurl = "json/";
}

if(file_exists($jsonurl."list.txt")){
    $jsonlist = explode(",",file_get_contents($jsonurl."list.txt"));
    $index = 0;

    echo "[";
    foreach($jsonlist as $value){
        if($value != null && strlen($value) > 3 && $index < count($jsonlist) - 2){
          echo file_get_contents($jsonurl.$value).",";
        }  
        else{
            if($value != null && strlen($value) > 3){
              echo file_get_contents($jsonurl.$value);
            }
        }
        $index += 1;
    }
    echo "]";
}
else{
    echo "[]";
}


?></div>
<div id = "memedata" style = "display:none;" class = "no-mathjax"><?php

if(isset($_GET['path'])){
    $memeurl = $_GET['path']."memes/";
}
else{
    $memeurl = "memes/";
}

if(file_exists($memeurl."list.txt")){
    $memelist = explode(",",file_get_contents($memeurl."list.txt"));
    $index = 0;
    foreach($memelist as $value){
      if($value != null && strlen($value) > 3 && $index < count($memelist) - 2){
          echo file_get_contents($memeurl.$value).",";
      }  
    else{
          if($value != null && strlen($value) > 3){
              echo file_get_contents($memeurl.$value);
          }
    }
    $index += 1;
    }    
}


?></div>
<?php
    if(isset($_GET['url'])){
        //url is set--remote page grabbed from somewhere on net
        //if path and url are both set, default to url
        echo file_get_contents($_GET['url']);
    }
    if(!isset($_GET['url']) && !isset($_GET['path'])){
        //neither url nor path is set, default to root feed
        echo file_get_contents("html/feed.txt");
    }
    if(isset($_GET['path'])  && !isset($_GET['url'])){
        //path is set, but NOT url, get path 
        echo file_get_contents($_GET['path']."/html/feed.txt");
    }
?>

<style>

body{
    font-size:1.5em;
    font-family:helvetica;
}
</style>
</body>
</html>