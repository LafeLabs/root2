<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/root2/master/feed/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach($dna as $dirs){
        mkdir($dirs);
        mkdir($dirs."/html");
        mkdir($dirs."/svg");
        mkdir($dirs."/feeds");
        mkdir($dirs."/json");
        mkdir($dirs."/memes");
        $data = file_get_contents($baseurl."/".$dirs."/html/feed.txt");
        $file = fopen($dirs."/html/feed.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file
    }
?>

<a href = "index.php?tree.php" style = "font-size:5em;">TREE</a>
