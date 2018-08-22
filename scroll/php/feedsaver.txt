 <?php
/* javascript this pairs with:

 document.getElementById("savesvg").onclick = function(){
        currentJSON = {};
        currentJSON.glyph = currentTable[currentAddress];
        currentJSON.unit = unit;
        currentJSON.x0 = x0;
        currentJSON.y0 = y0;
        currentJSON.x0rel = (x0 - 0.5*innerWidth)/unit;
        currentJSON.y0rel = (y0 - 0.5*innerHeight)/unit;
        currentJSON.imgurl = imagedata[0].value;
        currentJSON.imgw = parseFloat(imagedata[1].value);
        currentJSON.imgleft = parseFloat(imagedata[2].value);
        currentJSON.imgtop = parseFloat(imagedata[3].value);
        currentSVG = "<svg width=\"" + innerWidth.toString() + "\" height=\"" + innerHeight.toString() + "\" viewbox = \"0 0 " + innerWidth.toString() + " " + innerHeight.toString() + "\"  xmlns=\"http://www.w3.org/2000/svg\">\n";
        currentSVG += "\n<!--\n<json>\n" + JSON.stringify(currentJSON,null,"    ") + "\n</json>\n-->\n";
        doTheThing(0300);
        drawGlyph(currentTable[currentAddress]);
        currentSVG += "</svg>";
        document.getElementById("textIO").value = currentSVG;
        var httpc = new XMLHttpRequest();
        var url = "feedsaver.php";        
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpc.send("data=" + encodeURIComponent(document.getElementById("textIO").value));//send text to saver.php
 }

*/

    if(isset($_POST['path'])){
        $path = $_POST['path'];
        $indexpath = $path."scrolls/index.html";
        $feedpath = $path."scrolls/";   
    }
    else{
        $indexpath = "scrolls/index.html";
        $feedpath = "scrolls/";
    }

    $data = $_POST["data"]; //get data 
    $filename = "scroll".time().".txt";
    $file = fopen($feedpath.$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
    $oldfeed = file_get_contents($indexpath); 
    $file = fopen($indexpath,"w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\">".$filename."</a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file
?>