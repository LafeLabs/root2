<!doctype html>
<html>
<head>
<title>Page</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO PROPERTY
NO MINING

LOOK AT THE INSECTS
LOOK AT THE FUNGI
LANGUAGE IS HOW THE MIND PARSES REALITY
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
<div id = "jsondiv" style = "display:none"><?php

if(isset($_GET['json'])){
    echo file_get_contents($_GET['json']);
}

?></div>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<?php
    if(isset($_GET['url'])){
        echo file_get_contents($_GET['url']);
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents($_GET['path']."html/page.txt");
    }
    if(!isset($_GET['url']) && !isset($_GET['path'])){
        echo file_get_contents("html/page.txt");
    }
?>

<style>
body{
    font-family:Helvetica;
    font-size:1.5em;
}
h1,h2,h3,h4,h5{
    width:100%;
    text-align:center;
}
</style>

</body>
</html>