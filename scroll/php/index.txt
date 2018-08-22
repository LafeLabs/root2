<!doctype html>
<html>
    <head>
        <title>Scroll Reader</title>
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
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
</div>
        <a id = "editorlink" href = "tree.php">tree.php</a>
        <a id = "scrolleditorlink" href = "scrolleditor.php">scrolleditor.php</a>
        <div id = "readerscroll" class = "scroll">
        <?php

            if(isset($_GET['url'])){
                echo file_get_contents($_GET['url']);
            }
            if(isset($_GET['path'])){
                echo file_get_contents($_GET['path']."html/scroll.txt");
            }
            if(!isset($_GET['path']) && !isset($_GET['url'])){
                echo file_get_contents("html/scroll.txt");
            }
        ?>
        </div>
        <script>
            path = document.getElementById("pathdiv").innerHTML;
            if(path.length > 1){
                document.getElementById("scrolleditorlink").href = "scrolleditor.php?path="+path;
            }
        </script>
        <style>
            * {
            box-sizing: border-box;
            }
            body{
             overflow:hidden;   
            }
            .scroll{
                width:100%;
                padding:2em 2em 2em 2em;
                font-size:2em;
                text-align:justify;
                overflow:scroll;
                position:absolute;
                top:3em;
                left:0px;
                right:0px;
                bottom:0px;
            }
            .scroll img{
                width:80%;
                display:block;
                margin:auto;
            }
            .scroll p,pre,li {
	            font-family: Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif;
	            font-size: 24px;
            	font-style: normal;
	            font-variant: normal;
	            font-weight: 400;
	            line-height: 32px;
	            width:100%;
	            text-align:justify;
	                margin-bottom:1em;

            }
            .scroll h1,h2,h3,h4{
                text-align:center;
            }
            .scroll table{
                text-align:center;
                border-collapse:collapse;
                margin:auto;
                width:auto;

            }
            .scroll td{
                border:solid;
            }
            a{
                	            font-family: Book Antiqua, Palatino, Palatino Linotype, Palatino LT STD, Georgia, serif;
	            font-size: 24px;
            	font-style: normal;
	            font-variant: normal;
	            font-weight: 400;

            }
           #editorlink{
               position:absolute;
               right:10%;
               top:0.5em;
           }
           #scrolleditorlink{
               position:absolute;
               left:10%;
               top:0.5em;
           }
        </style>
    </body>
</html>