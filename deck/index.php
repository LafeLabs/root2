<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERTY

LOOK TO THE INSECTS
LOOK TO THE FUNGI
LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!-- links to MathJax JavaScript library, un-comment to use math-->
<!--

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>

-->

<!--  forward to another page:  -->
<!--<meta http-equiv="Refresh" content="0;url=tree.php">-->
<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
</head>
<body>
<div class= "no-mathjax" id = "memedatadiv" style = "display:none"><?php
if(isset($_GET['meme'])){
    echo file_get_contents($_GET['meme']);
}?></div>
<div class= "no-mathjax" id = "deckdatadiv" style = "display:none"><?php
if(isset($_GET['deck'])){
    echo file_get_contents($_GET['deck']);
}
?></div>
<div class= "no-mathjax" id = "listdatadiv" style = "display:none"><?php
    
    echo file_get_contents("../feed/aligner/memes/list.txt");

?></div>
<div id = "mainContainer">
<input id = "memeurlinput"/>
    <img id = "mainImage"/>
    <div class = "box"></div>
    <div class = "box"></div>   
    <div class = "box"></div>
    <div class = "box"></div>
    <div class = "box"></div>
    <div class = "box"></div>
    <div class = "box"></div>
    <div class = "box"></div>
</div>
<p><a href = "editor.php">editor</a></p>
<script>

deckmode = false;
mememode = false;
memeIndex  =0;
deck = [];
if(document.getElementById("memedatadiv").innerHTML.length > 5){
    memejson =  JSON.parse(document.getElementById("memedatadiv").getElementsByClassName("jsondata")[0].innerHTML);
    mememode = true;
}
if(document.getElementById("deckdatadiv").innerHTML.length > 5){
    deckjson =  JSON.parse(document.getElementById("memedatadiv").innerHTML);
    deckmode = true;
    mememode = false;
    deckIndex = 0;
    currentFile = deckjson[deckIndex];
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memedatadiv").innerHTML = this.responseText;
            
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();

}
if(!mememode && !deckmode){
    list = document.getElementById("listdatadiv").innerHTML;
    listarray = list.split(",");
    deck = [];
    for(var index = 0;index < listarray.length;index++){
        if(listarray[index].length > 1){
            deck.push("../feed/aligner/memes/" + listarray[index]);
        }
    }
    currentFile = deck[memeIndex];
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memedatadiv").innerHTML = this.responseText;
            initmeme();
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}

document.getElementById("memeurlinput").onchange = function(){
    currentFile = this.value;
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memedatadiv").innerHTML = this.responseText;
            initmeme();
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}

databoxes = document.getElementById("memedatadiv").getElementsByClassName("box");
displayboxes = document.getElementById("mainContainer").getElementsByClassName("box");

function initmeme(){
    databoxes = document.getElementById("memedatadiv").getElementsByClassName("box");
    memejson =  JSON.parse(document.getElementById("memedatadiv").getElementsByClassName("jsondata")[0].innerHTML);
    document.getElementById("mainImage").src = memejson.url;
    
}

document.getElementById("mainImage").onload = function(){
    image_aspect_ratio = this.width/this.height;// "widthiness", "wideness"
    screen_aspect_ratio = innerWidth/innerHeight;
    if(image_aspect_ratio >= screen_aspect_ratio){
        this.width = innerWidth;
        this.style.left = "0px";
        this.style.top = (0.5*(innerHeight - this.height)).toString() + "px";
        x0 = 0;
        y0 = 0.5*(innerHeight - this.height);
        w = this.width;
    }
    if(image_aspect_ratio < screen_aspect_ratio){
        this.height = innerHeight;
        this.style.top = "0px";
        this.style.left = (0.5*(innerWidth - this.width)).toString() + "px";
        x0 = 0.5*(innerWidth - this.width);
        y0 = 0;
        w = this.width;
    }
    for(var index = 0;index < databoxes.length;index++){
        displayboxes[index].innerHTML = databoxes[index].innerHTML;
        displayboxes[index].style.display = "block";
        displayboxes[index].style.left = (x0 + w*memejson.boxes[index].xoverw).toString() + "px";
        displayboxes[index].style.top = (y0 + w*memejson.boxes[index].yoverw).toString() + "px";
        displayboxes[index].style.width = (w*memejson.boxes[index].woverw).toString() + "px";
        displayboxes[index].style.fontSize = (w*memejson.boxes[index].xoverw*memejson.fontoverw).toString() + "px";
        displayboxes[index].style.transform = "rotate("+ (memejson.boxes[index].angle).toString() + "deg)";
        
    }
    for(var index = databoxes.length;index < displayboxes.length;index++){
        displayboxes[index].style.display = "none";
    }
    

}

mc = new Hammer(document.getElementById("mainContainer"));
mc.on("swipeleft swiperight", function(ev) {
    if(ev.type == "swipeleft"){
        prevmeme();
    }
    if(ev.type == "swiperight"){
        nextmeme();
    }

});

function nextmeme(){
    memeIndex++;
    if(memeIndex > deck.length - 1){
        memeIndex = 0;
    }
    currentFile = deck[memeIndex];
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memedatadiv").innerHTML = this.responseText;
            initmeme();
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}
function prevmeme(){
    memeIndex--;
    if(memeIndex < 0){
        memeIndex = deck.length - 1;
    }
    currentFile = deck[memeIndex];
    var httpc = new XMLHttpRequest();
    httpc.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("memedatadiv").innerHTML = this.responseText;
            initmeme();
        }
    };
    httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
    httpc.send();
}

</script>
<style>
body{
    font-size:1.5em;
    font-family:helvetica;
    overflow:hidden;
}

#memeurlinput{
    position:absolute;
    left:0px;
    top:0px;
    z-index:1;
}
#mainImage{
    position:absolute;
    z-index:-1;
}
.box{
    position:absolute;
    z-index:0;
}
</style>
</body>
</html>