<!doctype html>
<html>
<head>
<title>Map</title>
<?php
    echo file_get_contents("html/head.txt");
?>   
<script>
<?php
    echo file_get_contents("javascript/conversion.txt");
?>   
</script>
</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>

<div style = "display:none" id = "viewdata"><?php
    
    if(isset($_GET['view'])){
        echo file_get_contents($_GET['view']);
    }
    else{
        if(isset($_GET['path'])){
            echo file_get_contents($_GET['path']."json/view.txt");
        }
        else{
            echo file_get_contents("json/view.txt");
        }
    }

?></div>
<div style = "display:none" id = "setdata"><?php
    
    if(isset($_GET['set'])){
        echo file_get_contents($_GET['set']);
    }
    else{

        if(isset($_GET['path'])){
            echo file_get_contents($_GET['path']."json/set.txt");
        }
        else{
            echo file_get_contents("json/set.txt");
        }
    }
    
?></div>
<div style = "display:none" id = "mapdata"><?php 
        
    if(isset($_GET['map'])){
        echo file_get_contents($_GET['map']);
    }
    else{
        if(isset($_GET['path'])){
            echo file_get_contents($_GET['path']."json/map.txt");
        }
        else{
            echo file_get_contents("json/map.txt");
        }
    }

?></div>
<div style = "display:none" id  = "contentdata"><?php

    if(isset($_GET['set'])){
        $setdata = json_decode(file_get_contents($_GET['set']));
    }
    else{
        if(isset($_GET['path'])){
            $setdata = json_decode(file_get_contents($_GET['path']."json/set.txt"));
        }
        else{
            $setdata = json_decode(file_get_contents("json/set.txt"));
        }
    }

foreach($setdata as $datum){
    echo "\n<datum>\n";
    echo file_get_contents($datum->url);
    echo "\n</datum>\n";
}

?></div>

<?php
    echo file_get_contents("html/page.txt");
?>   

<script>
<?php
    echo file_get_contents("javascript/pageevents.txt");
?>   

init();
function init(){
<?php
    echo file_get_contents("javascript/init.txt");
?>   
}
redraw();
function redraw(){
<?php
    echo file_get_contents("javascript/redraw.txt");
?>   
}
</script>

<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>

</body>
</html>