<!doctype html>
<html>
<head>
<title>index</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

Trust model: Trust all non-coders implicitly, assume the worst from anyone who makes any money off computer industry in any way.  All professional coders are the Enemy.

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE
NO MONEY
NO PROPERTY
NO MINING
EGO DEATH:
    LOOK TO THE INSECTS
    LOOK TO THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
<!-- links to MathJax JavaScript library, un-comment to use math-->

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
</head>
<body>
<div id = "datadiv" style = "display:none"><?php 
if(isset($_GET['url'])){
    echo file_get_contents($_GET['url']);
}
else{
    echo file_get_contents("jupyter/notebook.ipynb");
}

?></div>

<div id = "page"></div>
<script>

currentJSON = JSON.parse(document.getElementById("datadiv").innerText);

for(var index = 0;index < currentJSON.cells.length;index ++){
    var newp = document.createElement("P");
    if(currentJSON.cells[index].cell_type == "markdown"){
        newp.innerHTML = currentJSON.cells[index].source[0];
    }
    if(currentJSON.cells[index].cell_type == "code"){
        
        var newpre = document.createElement("PRE");
        newpre.innerHTML = "";
        for(var codeindex = 0;codeindex < currentJSON.cells[index].source.length;codeindex++){
            newpre.innerHTML += currentJSON.cells[index].source[codeindex];
        }
        newp.appendChild(newpre);

        if(currentJSON.cells[index].outputs.length > 0){
            newp.innerHTML = index.toString() + ":" + currentJSON.cells[index].outputs.length.toString();
            for(var outputindex = 0;outputindex < currentJSON.cells[index].outputs.length;outputindex++){
                    newp.innerHTML += "<p>" + currentJSON.cells[index].outputs[outputindex].output_type + "</p>";
                    
                    if(currentJSON.cells[index].outputs[outputindex].output_type == "execute_result"){

                     var dataoutarray = currentJSON.cells[index].outputs[outputindex].data["text/plain"];
                        var zeep = "";
                        for(var j=0;j < dataoutarray.length;j++){
                            zeep += dataoutarray[j];
                        }
                        var newta = document.createElement("textarea");
                        newta.value = zeep;
                        newp.appendChild(newta);
                    }
                    if(currentJSON.cells[index].outputs[outputindex].output_type == "stream"){
                        var dataoutarray = currentJSON.cells[index].outputs[outputindex].text;
                        var zeep = "";
                        for(var j=0;j < dataoutarray.length;j++){
                            zeep += dataoutarray[j];
                        }
                        var newta = document.createElement("textarea");
                        newta.value = zeep;
                        newp.appendChild(newta);
                        
                    }
                    if(currentJSON.cells[index].outputs[outputindex].output_type == "display_data"){
                        var imgsrc = currentJSON.cells[index].outputs[outputindex].data["image/png"];
                        var newimg = document.createElement("IMG");
                        newimg.src = "data:image/png;base64," + imgsrc;
                        newp.appendChild(newimg);
                        
                    }
                    
                    
            }

        }
    }

    document.getElementById("page").appendChild(newp);
}




</script>
<style>
pre{
    font-family:courier;
    border:solid;
    margin-top:4em;
}
</style>
</body>
</html>