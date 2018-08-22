<!doctype html>
<html>
    <head>
    </head>
    <body>
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
<?php

    if(isset($_GET['path'])){
        $path =  $_GET['path'];
        $figurePath = $path."figures/";
        $files = scandir(getcwd()."/".$path."figures");
    }
    else{
        $figurePath = "figures/";
        $files = scandir(getcwd()."/figures");
    }



foreach($files as $value){
    if($value != "." && $value != ".."){
        echo "<p>".$figurePath.$value."</p>";
        echo "<p><a href = \"".$figurePath.$value."\"><img src = \"".$figurePath.$value."\"/></a></p>";
    }
}
?>
<a href = "scrolleditor.php" id = "editlink">scrolleditor.php</a>

<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length>1){
        document.getElementById("editlink").href = "scrolleditor.php?path=" + path;
    }
</script>
        <style>
            img{
    width:500px;   
}
p{
    font-size:24px;
    font-family:Helvetica;
}
            
        </style>
    </body>
</html>



