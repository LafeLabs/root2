<!doctype html>
<html>
<head>
<title>Geometron Meme</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
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
<div id = "datadiv" style = "display:none"><?php

    if(isset($_GET['path'])){
        $svgcode = file_get_contents($_GET['path']."currentsvg.svg");
    }
    else{
        $svgcode = file_get_contents("currentsvg.svg");
    }              
    $topcode = explode("</json>",$svgcode)[0];
    $outcode = explode("<json>",$topcode)[1];
    echo $outcode;  
?></div>
<div id = "svgdatadiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        $svgcode = file_get_contents($_GET['path']."currentsvg.svg");
    }
    else{
        $svgcode = file_get_contents("currentsvg.svg");
    }              
    echo $svgcode;
?></div>
<div id = "page">
<table id = "buttontable">
    <tr>
        <td class= "button">+ 1px</td>
        <td class= "button">- 1px</td>
        <td class= "button">-1 deg</td>
        <td class= "button">+1 deg</td>
        <td class= "button">up</td>
        <td class= "button">down</td>
        <td class= "button">left</td>
        <td class= "button">right</td>

    </tr>
</table>
    <a href = "" id = "backlink"></a>
    <input id = "urlinput"/>
    <img id = "backimg"/>
    <img id = "svgimg" src = "currentsvg.svg"/>
</div>
<script>

var myElement = document.getElementById('page');
var mc = new Hammer(myElement);

path = document.getElementById("pathdiv").innerHTML;
if(path.length > 1){
    document.getElementById("svgimg").src = path + "currentsvg.svg";
}

currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);

document.getElementById("svgimg").style.left = (0.5*innerWidth - 0.5*currentJSON.svgwidth).toString() + "px";
document.getElementById("svgimg").style.top = (0.5*innerHeight - 0.5*currentJSON.svgheight).toString() + "px";
document.getElementById("urlinput").value = currentJSON.imgurl;
document.getElementById("backimg").src = currentJSON.imgurl;

document.getElementById("backimg").style.left = (0.5*innerWidth + currentJSON.unit*currentJSON.imgleft).toString() + "px";
document.getElementById("backimg").style.top = (0.5*innerHeight + currentJSON.unit*currentJSON.imgtop).toString() + "px";
document.getElementById("backimg").style.width = (currentJSON.unit*currentJSON.imgw).toString() + "px";
document.getElementById("backimg").style.transform =  "rotate(" + (currentJSON.imgangle).toString() + "deg)";

document.getElementById("urlinput").onchange = function(){
    currentJSON.imgurl = this.value;
    document.getElementById("backimg").src = currentJSON.imgurl;
}


svgtop = document.getElementById("svgdatadiv").innerHTML.split("<json>")[0];
svgbottom = document.getElementById("svgdatadiv").innerHTML.split("</json>")[1];

mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
//mc.get('rotate').set({ enable: true });
//mc.get('pinch').set({ enable: true });

// listen to events...
mc.on("panleft panright panup pandown tap press", function(ev) {

    document.getElementById("backimg").style.left = (0.5*innerWidth + ev.deltaX + currentJSON.unit*currentJSON.imgleft).toString() + "px";
    document.getElementById("backimg").style.top = (0.5*innerHeight + ev.deltaY +  currentJSON.unit*currentJSON.imgtop).toString() + "px";
    document.getElementById("backimg").style.width = (currentJSON.unit*currentJSON.imgw*ev.scale).toString() + "px";

    document.getElementById("backimg").style.transform =  "rotate(" + (currentJSON.imgangle + ev.rotation).toString() + "deg)";

    x = currentJSON.imgleft + ev.deltaX/currentJSON.unit;
    y = currentJSON.imgtop + ev.deltaY/currentJSON.unit;

    if(ev.isFinal && (ev.type == "panup" || ev.type == "pandown" || ev.type == "panleft" || ev.type == "panright") ){
        currentJSON.imgleft = x;
        currentJSON.imgtop = y;
    }
    
    
});

buttons = document.getElementById("buttontable").getElementsByTagName("TD");

buttons[0].onclick = function(){
        currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgw += 2/currentJSON.unit;
    currentJSON.imgleft -= 1/currentJSON.unit;
    currentJSON.imgtop -= 1/currentJSON.unit;
    redraw();
}
buttons[1].onclick = function(){
        currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgw -= 2/currentJSON.unit;
    currentJSON.imgleft += 1/currentJSON.unit;
    currentJSON.imgtop += 1/currentJSON.unit;
    redraw();
}

buttons[2].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;
    currentJSON.imgangle -= 1;
    redraw();
}
buttons[3].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;
    currentJSON.imgangle += 1;
    redraw();
}


buttons[4].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgtop -= 1/currentJSON.unit;
    redraw();
}
buttons[5].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgtop += 1/currentJSON.unit;
    redraw();
}
buttons[6].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgleft -= 1/currentJSON.unit;
    redraw();
}
buttons[7].onclick = function(){
    currentJSON.imgleft = x;
    currentJSON.imgtop = y;

    currentJSON.imgleft += 1/currentJSON.unit;
    redraw();
}


function redraw(){
    document.getElementById("backimg").style.left = (0.5*innerWidth + currentJSON.unit*currentJSON.imgleft).toString() + "px";
    document.getElementById("backimg").style.top = (0.5*innerHeight + currentJSON.unit*currentJSON.imgtop).toString() + "px";   
    document.getElementById("backimg").style.width = (currentJSON.unit*currentJSON.imgw).toString() + "px";
    document.getElementById("backimg").style.transform =  "rotate(" + (currentJSON.imgangle).toString() + "deg)";
    
    
}

</script>
<style>
#buttontable{
    position:absolute;
    left:0px;
    bottom:0px;
    width:100%;
    z-index:3;
}
#buttontable tr{
    width:100%;
}
#buttontable td{
    width:10%;
    height:3em;
    font-size:1em;
}
.button{
    border-radius:0.5em;
    text-align:center;
    font-family:courier;
    cursor:pointer;
    border:solid;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}
#page{
    position:absolute;
    left:0px;
    right:0px;
    top:0px;
    bottom:0px;
    overflow:hidden;
}
    #svgimg{
     position:absolute;   
    }
    #urlinput{
        width:90%;
        left:1em;
        font-size:2em;
        position:absolute;
        top:1em;
        border:solid;
        font-family:courier;
        z-index:3;
    }
    #backimg{
        position:absolute;
    }
</style>
</body>
</html>