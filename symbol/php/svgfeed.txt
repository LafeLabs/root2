 <!doctype html>
<html>
<head>
<title>Parse SVG's</title>
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

</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>

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

            $topcode = explode("</json>",$svgcode)[0];
            $outcode = explode("<json>",$topcode)[1];
            $currentjson = json_decode($outcode);


            $imgw = $currentjson->imgw;
            $imgurl = $currentjson->imgurl;
            $imgleft = $currentjson->imgleft;
            $imgtop = $currentjson->imgtop;
            $imgangle = $currentjson->imgangle;

            $svgheight = $currentjson->svgheight;
            $svgwidth = $currentjson->svgwidth;

            $unit = $currentjson->unit;
            $x0 = $currentjson->x0;
            $y0 = $currentjson->y0;

            $x0 = 0.5*$svgwidth;
            $y0 = 0.5*$svgheight;

            $x0rel = $currentjson->x0rel;
            $y0rel = $currentjson->y0rel;

            $width = $imgw*$unit;
            $left = 1 + $x0 + $unit*$imgleft;
            $top = 1 + $y0 + $unit*$imgtop;


            echo "\n<p style = \"position:relative;margin:auto;margin-top:3em;border:solid;width:".$svgwidth."px;height:".$svgheight."px;\">\n    <a href = \"index.php?url=";
            echo $svgpath2.$value;
            echo "\">\n        <img src = \"";        
            echo $imgurl;
            echo "\" style = \"width:";
            echo $width;
            echo "px;";
//            echo "transform:rotate(".$imgangle."deg);";
            echo "position:absolute;left:".$left."px;top:".$top."px;\"/>";
            echo "\n        <img style = \"position:relative;left:0px;top:0px;z-index:0;\" src = \"".$svgpath2.$value."\"/>";
            echo "\n    </a>\n</p>\n";
            

        }
    }
?>
</div>
<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }
</script>
<style>

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
        border-color:white;
    }
    p{
        border:solid;
        box-sizing: border-box;
        border-color:white;
        margin-top:10em;
        margin-bottom:3em;
    }

</style>
</body>
</html>