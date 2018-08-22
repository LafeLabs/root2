<?php
/*

//http://localhost:8000/page/pageeditor.php?path=physics/quantumnoise

document.getElementById("loadbutton").onclick = function(){
    
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            filedata = this.responseText;
            editor.setValue(filedata);
            document.getElementById("scroll").innerHTML = filedata;
            var httpc2 = new XMLHttpRequest();
            var url = "filesaver.php";        
            httpc2.open("POST", url, true);
            httpc2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
            httpc2.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
        }
    };
    httpc.open("GET", "loadpage.php?path=" + path, true);
    httpc.send();
}
*/


if(isset($_GET['path'])){
    $path =  $_GET['path'];
    $files = scandir(getcwd()."/".$path."/pages");
}
else{
    $path = "";
    $files = scandir(getcwd()."/pages");
}

$latesttime = 0;

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,4) == "page"){
     //   echo $value."<br/>".substr(substr($value,4),0,-4)."<br/>";
        $timestamp = substr(substr($value,4),0,-4);
     //   echo gmdate("Y-m-d H:i:s", $timestamp)."<br/>";     
     //   echo intval($timestamp) - 4287;
     //   echo "<br/>";
        if($timestamp > $latesttime){
            $latesttime = $timestamp;
        }
    }
}

if(isset($_GET['path'])){
    $latestfilename = $path."/pages/page".$latesttime.".txt";
}
else{
    $latestfilename = "pages/page".$latesttime.".txt";
}

echo file_get_contents($latestfilename);

?>
