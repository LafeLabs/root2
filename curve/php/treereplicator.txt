<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/root2/master/curve/json/treedna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach($dna as $dirs){
        mkdir($dirs);
        mkdir($dirs."/svg");
        mkdir($dirs."/javascript");
        mkdir($dirs."/html");
        mkdir($dirs."/json");

        $data = file_get_contents($baseurl."/".$dirs."/javascript/topfunctions.txt");
        $file = fopen($dirs."/javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/".$dirs."/json/currentjson.txt");
        $file = fopen($dirs."/json/currentjson.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/".$dirs."/json/plotdata.txt");
        $file = fopen($dirs."/json/plotdata.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/".$dirs."/html/equation.txt");
        $file = fopen($dirs."/html/equation.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

    }
?>

<a href = "tree.php" style = "font-size:5em;">TREE</a>
