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
<div style = "display:none" id = "viewdata"><?php
    echo file_get_contents("json/view.txt");
?></div>
<div style = "display:none" id = "setdata"><?php
    echo file_get_contents("json/set.txt");
?></div>
<div style = "display:none" id  = "contentdata"><?php

$setdata = json_decode(file_get_contents("json/set.txt"));

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