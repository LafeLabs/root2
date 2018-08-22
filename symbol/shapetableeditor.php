<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/keyboard.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";

if(isset($_GET['path'])){
    if(file_exists($_GET['path']."/bytecode/shapetable.txt")){
        echo file_get_contents($_GET['path']."/bytecode/shapetable.txt")."\n";
    }
    if(file_exists($_GET['path']."/bytecode/font.txt")){
        echo file_get_contents($_GET['path']."/bytecode/font.txt")."\n";
    }
}

?>
*/
</script>
<script id = "topfunctions">
<?php
echo file_get_contents("javascript/topfunctions.txt");
?>   
</script>
<script id = "actions">
function doTheThing(localCommand){    
    if(localCommand >= 040 && localCommand <= 0176){
        currentHTML += String.fromCharCode(localCommand);
        currentWord += String.fromCharCode(localCommand);
    }
    if(localCommand >= 0200 && localCommand <= 0277){//shapes 
        if(!(localCommand == 0207 && editMode == false) ){
            drawGlyph(currentTable[localCommand]);    	    
        }
    }
    if(localCommand >= 01000 && localCommand <= 01777){//symbol glyphs
            drawGlyph(currentTable[localCommand]);    	    
    } 
    <?php
    echo file_get_contents("javascript/actions03xx.txt");
    echo "\n";
    echo file_get_contents("javascript/actions0xx.txt");
    echo "\n";
    ?>    
}
</script>
</head>
<body>
<div id = "backurldata" style = "display:none"><?php

    if(isset($_GET['backlink'])){
        echo $_GET['backlink'];
    }
    

?></div>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "stylejsondiv"  style = "display:none"><?php

echo file_get_contents("json/stylejson.txt");
    
?></div>
<div id = "datadiv" style = "display:none">
<?php
    echo file_get_contents("json/currentjson.txt");
?>
</div>    
<div id = "page">
    <a  id = "editorlink" href = "editor.php">editor.php</a>
    <a  id = "factorylink" href = "index.php">index.php</a>
    <a id = "backlink" href = ""></a>

    <canvas id="invisibleCanvas" style="display:none"></canvas>
    <canvas id="mainCanvas"></canvas>
    <textarea id="textIO"></textarea>
    <table id = "zoompan">
        <tr>
            <td class = "button">up</td>
            <td class = "button">down</td>
            <td class = "button">left</td>
            <td class = "button">right</td>
            <td class = "button">out</td>
            <td class = "button">in</td>
        </tr>
    </table>
    <table id = "controlTable">
        <tr id = "addressline">
            <td>ADDRESS:</td><td><input/></td>
        </tr>
        <tr>
            <td>ACTION:</td><td><input/></td>
        </tr>
        <tr>
            <td>PRINT:</td><td><input/></td>
        </tr>
        <tr>
            <td>STACK:</td><td><input/></td>
        </tr>
    </table>
    <table id = "imageTable">   
    <tr>
        <td>IMAGE URL:</td><td><input/></td>
    </tr>
    <tr>
        <td>IMAGE WIDTH:</td><td><input/></td>
    </tr>
    <tr>
        <td>IMAGE TOP:</td><td><input/></td>
    </tr>
    <tr>
        <td>IMAGE LEFT:</td><td><input/></td>
    </tr>
    <tr>
        <td>IMAGE ANGLE:</td><td><input/></td>
    </tr>
</table>
    <table id = "buttonTable">
        <tr><td class = "button" id = "actionsymbol">ACTION/SYMBOL</td></tr>
        <tr><td class = "button" id = "savetable">SAVE TABLE</td></tr>
        <tr><td class = "button" id = "savefont">SAVE FONT</td></tr>
        <tr><td class = "button" id = "importbytecode">IMPORT BYTECODE</td></tr>
        <tr><td class = "button" id = "exportshapes">EXPORT SHAPES</td></tr>
        <tr><td class = "button" id = "exportfont">EXPORT FONT</td></tr>
    </table>
    <input id = "glyphspellinput"/>
    <img id = "mainImage"/>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

path = document.getElementById("pathdiv").innerHTML;
if(path.length > 1){
    document.getElementById("factorylink").href = "index.php?path=" + path;
}

backlink = document.getElementById("backurldata").innerHTML;

if(backlink.length>1){
    document.getElementById("backlink").href = backlink;
    document.getElementById("backlink").innerHTML = backlink;
}
else{
    document.getElementById("backlink").href = "tree.php";
    document.getElementById("backlink").innerHTML = "tree.php";
}


currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
imagedata = document.getElementById("imageTable").getElementsByTagName("input");
styleJSON = JSON.parse(document.getElementById("stylejsondiv").innerHTML);

imagedata[0].value = currentJSON.imgurl;
imagedata[1].value = currentJSON.imgw;
imagedata[2].value = currentJSON.imgtop;
imagedata[3].value = currentJSON.imgleft;
imagedata[4].value = currentJSON.imgangle;

    document.getElementById("mainCanvas").width = innerWidth;
    document.getElementById("mainCanvas").height = innerHeight;

    x0 = innerWidth/2;
    y0 = innerHeight/2;    

    controls = document.getElementById("controlTable").getElementsByTagName("input");   
    unit = 100;
    currentAddress = 0220;

    currentGlyph = currentTable[currentAddress] + ",0207,";
    glyphEditMode = true;
    shapeTableEditMode = true;
    zoompanbuttons = document.getElementById("zoompan").getElementsByClassName("button");
    controls[1].select();
}

</script>
<script id = "redraw">
redraw();
function redraw(){
    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
    doTheThing(0300);
    drawGlyph(currentGlyph);
    doTheThing(0300);
    side = 25;
    x = 150;
    y = innerHeight - 100;
    spellGlyph(currentGlyph);
    controls[0].value = "0" + currentAddress.toString(8);
    var glyphArray = currentGlyph.split(",");
    currentTable[currentAddress] = "";
    for(var index = 0;index < glyphArray.length;index++){
        if(glyphArray[index] != "0207" && glyphArray[index].length > 0){
            currentTable[currentAddress] += glyphArray[index] + ",";
        }
    }
    
    var glyphArray = currentGlyph.split(",");
    cleanGlyph = "";
    for(var index = 0;index < glyphArray.length;index++){
        if(glyphArray[index] != "0207" && glyphArray[index].length > 0){
            cleanGlyph += glyphArray[index] + ",";
        }
    }

    document.getElementById("mainImage").style.width = (currentJSON.imgw*unit).toString()  + "px";
    document.getElementById("mainImage").style.left = (x0 + currentJSON.imgleft*unit).toString()  + "px";
    document.getElementById("mainImage").style.top = (y0 + currentJSON.imgtop*unit).toString()  + "px";
    document.getElementById("mainImage").style.transform = "rotate(" + currentJSON.imgangle.toString() +"deg)";
    document.getElementById("glyphspellinput").value = cleanGlyph;
    


if(currentAddress >= 0220 && currentAddress < 0277){
    if(path.length > 1){
        currentFile = path + "bytecode/shapetable.txt";
    }
    else{
        currentFile = "bytecode/shapetable.txt";
    }
    data = "";
    for(var index = 0220;index < 0277;index++){
        if(currentTable[index].length > 2){
            data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
        }
    }
    for(var index = 01220;index < 01277;index++){
        if(currentTable[index].length > 2){
            data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
        }
    }
}
if(currentAddress >= 01220 && currentAddress < 01277){
    if(path.length > 1){
        currentFile = path + "bytecode/shapetable.txt";
    }
    else{
        currentFile = "bytecode/shapetable.txt";
    }
    data = "";
    for(var index = 0220;index < 0277;index++){
        if(currentTable[index].length > 2){
            data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
        }
    }
    for(var index = 01220;index < 01277;index++){
        if(currentTable[index].length > 2){
            data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
        }
    }
}

if(currentAddress >= 01040 && currentAddress < 01177){
    if(path.length > 1){
        currentFile = path + "bytecode/font.txt";
    }
    else{
        currentFile = "bytecode/font.txt";
    }
    data = "";
    for(var index = 01040;index < 01177;index++){
        if(currentTable[index].length > 2){
            data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
        }
    }
}
    
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php


}
</script>
<script id = "pageevents">

document.getElementById("glyphspellinput").onchange = function(){
    cleanGlyph = this.value;
    currentGlyph = cleanGlyph + "0207,";
    redraw();
}

document.getElementById("actionsymbol").onclick = function(){
    if(currentAddress < 01000){
        currentAddress += 01000;
        currentGlyph = currentTable[currentAddress] + ",0207,";
        redraw();
    }
    else{
        currentAddress -= 01000;
        currentGlyph = currentTable[currentAddress] + ",0207,";
        redraw();
    }
}
document.getElementById("savetable").onclick = function(){
    currentFile = "bytecode/shapetable.txt";
    bytecodedata = "";
    for(var index = 0220;index < 0250;index++){
        if(currentTable[index].length > 1){
            bytecodedata += "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    for(var index = 01220;index < 01250;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }

    data = encodeURIComponent(bytecodedata);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
}
document.getElementById("savefont").onclick = function(){
    currentFile = "bytecode/font.txt";
    bytecodedata = "";
    for(var index = 01040;index < 01177;index++){
        if(currentTable[index].length > 1){
            bytecodedata += "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    data = encodeURIComponent(bytecodedata);
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    
}
document.getElementById("importbytecode").onclick = function(){
    var inputbytecode = document.getElementById("textIO").value;
    var bytecodearray = inputbytecode.split("\n");
    for(var index = 0;index < bytecodearray.length;index++){
        if(bytecodearray[index].includes(":")){
            var localBytecode = bytecodearray[index].split(":");
            var localAddress = parseInt(localBytecode[0],8);
            currentTable[localAddress] = localBytecode[1];
        }
    }
}
document.getElementById("exportshapes").onclick = function(){
    bytecodedata = "";
    for(var index = 0220;index < 0250;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" +  currentTable[index] + "\n";   
        }
    }
    for(var index = 01220;index < 01250;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    document.getElementById("textIO").value = bytecodedata;    
}
document.getElementById("exportfont").onclick = function(){
    bytecodedata = "";
    for(var index = 01040;index < 01177;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    document.getElementById("textIO").value = bytecodedata;    
    
}


controls[0].onchange = function(){
    currentAddress = parseInt(this.value,8);
    currentGlyph = currentTable[currentAddress] + ",0207,";
    redraw();
}

controls[1].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }
        if(charCode == 046){
//        doTheThing(023);
            currentAddress++;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
            arrowkey = true;
        }
        if(charCode == 050){
//        doTheThing(022);
            currentAddress--;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
            arrowkey = true;
        }    
    }
    
    controls[2].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }
    }
    
    controls[3].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }

    }
    
controls[1].onkeypress = function(a){//action
    charCode = a.keyCode || a.which;
    console.log(a.which);
    if(charCode != 010 && charCode != 047  && charCode != 050  && !arrowkey){
            
        if(parseInt(currentTable[charCode],8) >= 0200){
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                    currentGlyph += glyphSplit[index] + ",";
                }
                if(glyphSplit[index] == "0207"){
                    currentGlyph += currentTable[charCode] + ",0207,";
                }
            }
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                    currentGlyph += glyphSplit[index] + ",";
                }
            }
            redraw();
        } 
        if(parseInt(currentTable[charCode],8) < 040){
            doTheThing(parseInt(currentTable[charCode],8));
            redraw();
        }
        this.value = "";
    }
}
    
controls[2].onkeypress = function(a){//print
    charCode = a.keyCode || a.which;
    if(charCode != 010  && charCode != 047  && !arrowkey){
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode + 01000).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        this.value = "";
    }
}
    
controls[3].onkeypress = function(a){//stack
    charCode = a.keyCode || a.which;    
    if(charCode != 010 && charCode != 047  && !arrowkey){
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        this.value = "";
    }
}

zoompanbuttons[0].onclick = function(){
    doTheThing(030);
}
zoompanbuttons[1].onclick = function(){
    doTheThing(031);
}
zoompanbuttons[2].onclick = function(){
    doTheThing(032);
}
zoompanbuttons[3].onclick = function(){
    doTheThing(033);
}
zoompanbuttons[4].onclick = function(){
    doTheThing(036);
}
zoompanbuttons[5].onclick = function(){
    doTheThing(037);
}

imagedata[0].onchange = function(){
    document.getElementById("mainImage").src = this.value;
    currentJSON.imgurl = this.value;
}

imagedata[1].onchange = function(){
    currentJSON.imgw = parseFloat(this.value);
    redraw();
}
imagedata[2].onchange = function(){
    currentJSON.imgtop = parseFloat(this.value);
    redraw();
}
imagedata[3].onchange = function(){
    currentJSON.imgleft = parseFloat(this.value);
    redraw();
}
imagedata[4].onchange = function(){
    currentJSON.imgangle = parseFloat(this.value);
    redraw();
}
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>