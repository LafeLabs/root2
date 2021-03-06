<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/root2/master/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    //Seven Sources
    mkdir("page");
        mkdir("page/pages");
        mkdir("page/json");
    mkdir("feed");
        mkdir("feed/feed");
        mkdir("feed/json");
    mkdir("scroll");    
        mkdir("scroll/latex");
        mkdir("scroll/jupyter");
        mkdir("scroll/scrolls");
        mkdir("scrolls/figures");
    mkdir("deck");
    mkdir("symbol");
        mkdir("symbol/svg");
    mkdir("curve");
        mkdir("curve/svg");
    mkdir("map");

    foreach($dna as $dirs){
        mkdir($dirs->path);
        $files = $dirs->files;
        foreach($files as $filename){
            $data = file_get_contents($baseurl.$dirs->path."/".$filename);
            $file = fopen($dirs->path."/".$filename,"w");// create new file with this name
            fwrite($file,$data); //write data to file
            fclose($file);  //close file
            if(substr($dirs->path,-3) == "php" && $filename != "php/replicator.txt"){
                $file = fopen(substr($dirs->path,0,-3).explode(".",$filename)[0].".php","w");// create new file with this name
                fwrite($file,$data); //write data to file
                fclose($file);  //close file                
            }
        }    
    }
?>

<a href = "index.php" style = "font-size:5em;">index.php</a>
