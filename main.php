<?php
session_start();
$fname = $_SESSION['fname'];
echo $fname;
?>
<!DOCTYPE HTML>
<html>
<head>
<style>
#classSelect{
float:right;
}
#classes {
float:right;
}

 body {
     margin: 0px;
      padding: 0px;
   }
   #canvas {
     margin:5px;
     border: 1px solid #9C9898;
   }
</style>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script>
var c;
  window.onload = function() {



var canvasOffset;
var offsetX;
var offsetY;
var isDrawing = false;


    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var imageObj = new Image();

    imageObj.onload = function() {
      ctx.drawImage(imageObj, 0, 0);
    };
    imageObj.src = 
<?php 
echo '"'.$fname.'"'; 
?>




canvasOffset = $("#canvas").offset();
offsetX = canvasOffset.left;
offsetY = canvasOffset.top;

$("#canvas").on('mousedown', function (e) {
    handleMouseDown(e);
}).on('mouseup', function(e) {
    handleMouseUp();
}).on('mousemove', function(e) {
    handleMouseMove(e);
});


var startX,mouseX,mouseY;
var startY;

function handleMouseUp() {
	isDrawing = false;
	canvas.style.cursor = "default";
	ctx.beginPath();
	ctx.rect(startX, startY, mouseX - startX, mouseY - startY);		
	ctx.stroke();
	for (i = 0; i < 6; i++) {
			if ( document.myform.classes[i].checked ) {
				c = document.myform.classes[i].value;
				break;
			}
		}

		console.log("c="+c);
		var line = c+" "+ startX+" "+startY+" "+(mouseX - startX)+" "+(mouseY - startY)+"\n";
		if(document.getElementById(c).value.indexOf(line)==-1)
		document.getElementById(c).value += line;
			
}

function handleMouseMove(e) {
	if (isDrawing) {
		 mouseX = parseInt(e.clientX - offsetX);
		 mouseY = parseInt(e.clientY - offsetY);				
		
		//ctx.clearRect(0, 0, canvas.width, canvas.height);
		

		
		
	}
}

function handleMouseDown(e) {
	canvas.style.cursor = "crosshair";		
	isDrawing = true
	startX = parseInt(e.clientX - offsetX);
	startY = parseInt(e.clientY - offsetY);
	console.log(startX+"  "+ startY);
}


  };

</script>
</head>
<body>
<canvas id="canvas" width="781" height="671"></canvas>
<form name = "myform" method = "POST" action="generateSample.php" id="classSelect">
<input type="radio" name="classes" value="1">Class 1 <input type="text" name="label1"/><input name="c1" type="color"><br>
<input type="radio" name="classes" value="2">Class 2 <input type="text" name="label2"/><input name="c2" type="color"><br>
<input type="radio" name="classes" value="3">Class 3 <input type="text" name="label3"/><input name="c3" type="color"><br>
<input type="radio" name="classes"  value="4">Class 4 <input type="text" name="label4"/><input name="c4" type="color"><br>
<input type="radio" name="classes"  value="5">Class 5 <input type="text" name="label5"/><input name="c5" type="color"><br>
<input type="radio" name="classes"  value="6">Class 6 <input type="text" name="label6"/><input name="c6" type="color"><br>
 <textarea name="1" id="1" rows="4" cols="50">
</textarea> <br>
 <textarea name="2"id="2"rows="4" cols="50">
</textarea> <br>
 <textarea name="3"id="3"rows="4" cols="50">
</textarea> <br>
 <textarea name="4"id="4"rows="4" cols="50">
</textarea> <br>
 <textarea name="5"id="5"rows="4" cols="50">
</textarea> <br>
 <textarea name="6" id="6"rows="4" cols="50">
</textarea><br>
<input type="submit" value="Generate Sample Data File"/> 
</form>
<div id="classes">

</div>
</body>
</html>
