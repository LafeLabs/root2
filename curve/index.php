 <!doctype html>
<html>
<head>
<title>Function Plotter</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERY

LOOK AT THE FUNGI
LOOK AT THE INSECTS
LANGUAGE IS HOW THE MIND PARSES REALITY

-->

<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<script id = "topfunctions">

<?php

    if(isset($_GET['url']) && !isset($_GET['path'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</topfunctions>",$svgcode)[0];
        $outcode = explode("<topfunctions>",$topcode)[1];
        echo $outcode;
        $file = fopen("javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$outcode); //write data to file
        fclose($file);  //close file
    }
    if(isset($_GET['url']) && isset($_GET['path'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</topfunctions>",$svgcode)[0];
        $outcode = explode("<topfunctions>",$topcode)[1];
        echo $outcode;
        $file = fopen($_GET['path']."javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$outcode); //write data to file
        fclose($file);  //close file
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents($_GET['path']."javascript/topfunctions.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("javascript/topfunctions.txt");
    }

?>

</script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
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
</head>
<body>
<div id = "backurldata" style = "display:none"><?php

    if(isset($_GET['backlink'])){
        echo $_GET['backlink'];
    }
    

?></div>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "plotdatadiv" style = "display:none;"><?php
    echo file_get_contents("json/plotdata.txt");
?></div>
    
<div id = "jsondatadiv" style = "display:none;"><?php

    if(isset($_GET['url'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</currentjson>",$svgcode)[0];
        $outcode = explode("<currentjson>",$topcode)[1];
        echo $outcode;
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents($_GET['path']."json/currentjson.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("json/currentjson.txt");
    }


?></div>

<div id = "page">

<a id = "editorlink" href = "equationeditor.php">equationeditor.php</a>
<a id  = "uplink" href = "../">../</a>
<a id  = "backlink" href = ""></a>

<a id = "treelink" href = "tree.php">tree.php</a>

<a id  = "svgindexlink" href = "svg/index.html">SVG Plots</a>

<a id = "svgfeedlink" href = "svgfeed.php">svgfeed.php</a>

<canvas id="mainCanvas"></canvas>
<img id  = "pngimage" style = "display:none"/>

<img id = "mainImage"/>

<div id = "actionbox">Action:<input id = "actioninput"/></div>
<div id = "inputbox">Image URL:<input id = "imgurlinput"/></div>

<textarea id="textIO"></textarea> 

<table id = "valuedisplaytable">
    <tr>
        <td id="varname"></td><td>=</td><td id = "varvalue"></td>    
    </tr>
    <tr>
        <td>$\Delta$</td><td>=</td><td id = "delta"></td>    
    </tr>
</table>
<table id = "plotparamstable">
</table>
<table id = "funcparamstable">
</table>
<div id = "imgurldata" style = "display:none"><?php 
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</imgurl>",$svgcode)[0];
    $outcode = explode("<imgurl>",$topcode)[1];
    echo $outcode;
}
?></div>
<div id = "shadowequation" style = "display:none" class = "no-mathjax"><?php

if(isset($_GET['url']) && !isset($_GET['path'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</equation>",$svgcode)[0];
    $outcode = explode("<equation>",$topcode)[1];
    echo $outcode;
    $file = fopen("html/equation.txt","w");// create new file with this name
    fwrite($file,$outcode); //write data to file
    fclose($file);  //close file
}
if(isset($_GET['url']) && isset($_GET['path'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</equation>",$svgcode)[0];
    $outcode = explode("<equation>",$topcode)[1];
    echo $outcode;
    
    $file = fopen($_GET['path']."html/equation.txt","w");// create new file with this name
    fwrite($file,$outcode); //write data to file
    fclose($file);  //close file
}


if(isset($_GET['path']) && !isset($_GET['url'])){
    echo file_get_contents($_GET['path']."html/equation.txt");
}
if(!isset($_GET['path']) && !isset($_GET['url'])){
    echo file_get_contents("html/equation.txt");
}


?></div>
<div id = "equation">
<?php

if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    $svgcode = file_get_contents($_GET['url']);
    $topcode = explode("</equation>",$svgcode)[0];
    $outcode = explode("<equation>",$topcode)[1];
    echo $outcode;
}
if(isset($_GET['path'])){
    echo file_get_contents($_GET['path']."html/equation.txt");
}
if(!isset($_GET['path']) && !isset($_GET['url'])){
    echo file_get_contents("html/equation.txt");
}

?>
</div>
    <div class = "button" id = "publish">PUBLISH</div>
    <div class = "button" id = "pngbutton">PNG</div>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php
    $data = file_get_contents("javascript/init.txt");
    echo $data;    
?>
}
</script>
<script id = "redraw">
<?php
        echo "\nredraw();\n";
        echo "\nfunction redraw(){\n";
        $data = file_get_contents("javascript/redraw.txt");
        echo $data;
        echo "\n}\n";
?>
</script>
<script id = "pageevents">
<?php
    $data = file_get_contents("javascript/pageevents.txt");
    echo $data;    
?>
</script>
<?php
    echo "<style>\n";
    $data = file_get_contents("css/style.txt");
    echo $data;
    echo "</style>\n";
?>
</body>
</html>