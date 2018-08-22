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
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>

<a id = "editorlink" href = "equationeditor.php">equationeditor.php</a>
<a id = "indexlink" href = "index.php">index.php</a>

<div id = "scroll">
<?php

    if(isset($_GET['path'])){
        $path = $_GET['path'];
        $svgpath = "/".$path."svg";
        $svgpath2 = $path."svg/";

    }
    else{
        $svgpath = "/svg";
        $svgpath2 = "svg/";
    }
 
    $svgs = scandir(getcwd().$svgpath);
    $svgs = array_reverse($svgs);
    foreach($svgs as $value){
        if($value != "." && $value != ".." && substr($value,-4) == ".svg"){
            $svgcode = file_get_contents($svgpath2.$value);

            $topcode = explode("</currentjson>",$svgcode)[0];
            $outcode = explode("<currentjson>",$topcode)[1];
            $currentjson = json_decode($outcode);
            $width = $currentjson->plotparams->plotwidth;

            
            echo "\n<p style = \"position:relative;margin:auto;border:solid;width:".$width."px\"><a href = \"index.php?url=";
            echo $svgpath2.$value;
            echo "\"><img src = \"";        
            $svgcode = file_get_contents($svgpath2.$value);
            $topcode = explode("</imgurl>",$svgcode)[0];
            $outcode = explode("<imgurl>",$topcode)[1];
            if(strlen($outcode) > 4){
                $imgurl =  trim($outcode);
            }
            else{
                $imgurl = $svgpath2.$value;
            }
            echo $imgurl;
            

            echo "\" style = \"width:";
            echo $currentjson->plotparams->plotwidth;
            echo "px;position:relative;left:1px;top:1px;\"/>";
            echo "<img style = \"position:absolute;left:0px;top:0px;z-index:0;\" src = \"".$svgpath2.$value."\"/>";
            echo "\n</a></p>\n";
            
            echo "\n<div class = \"equation\">\n";
            $topcode = explode("</equation>",$svgcode)[0];
            $outcode = explode("<equation>",$topcode)[1];
            echo $outcode;
            echo "</div>";
            
        }
    }
?>
</div>
<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
        document.getElementById("editorlink").href = "equationeditor.php?path=" + path;
    }
</script>
<style>

#editorlink{
    left:1em;
    top:1em;
    position:absolute;
    z-index:3;

}
#indexlink{
    left:1em;
    top:3em;
position:absolute;
    z-index:3;

    
}

#scroll{
    position:absolute;
    left:0px;
    top:0px;
    bottom:0px;
    right:0px;
    overflow:scroll;
}
    
    img{
        box-sizing: border-box;
        border:solid;
    }
    p{
        border:solid;
        box-sizing: border-box;
    }
    .equation{
        border:none;
        width:50%;
        margin:auto;
        display:block;
        overflow:scroll;
        height:4em;
    }
    .equation p{
        border:none;
    }
    .equation:hover{
        height:10em;
    }
</style>
</body>
</html>