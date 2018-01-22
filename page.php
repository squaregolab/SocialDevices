<!-- SOCIALDEVICES V2.4 2018 - Main Page -->
<!DOCTYPE html>
<html><meta charset="UTF-8"/>
	<head>
		<script src="function.js"></script>
		<link rel="stylesheet" href="style_screen.css"/>
		
		<script src="modernizr-2.js"></script>
		<script src="fractal.js"></script>
		<title>SocialDevices</title>
	</head>

	<body onload="intialisation(event)">
		<div class="overlay"><!-- Overlay -->
			<div><!-- OverlayDown : Fractal -->
				<div class="containe">
					<div id="position"><!-- Canvas position --></div>
					<a id="btnRegenerate" value="regenerate"></a>
					<a id="btnExport" value="export image (png)"></a>
				</div>
			</div>
			<div class="middle"><!-- OverlayUp : Posts and sponsors -->
				<nav id="mySidenav" class="sidenav">
					<a id="filter" onclick="open_option()">Filter</a>
					<a id="counter" onclick="Restart_counter()">Counter</a>
					<a id="design">
						#Color1<input class="inputcolor" id="SelectionColor1" type="text" name="color1" value="00BEE1"/><br>
						#Color2<input class="inputcolor" id="SelectionColor2" type="text" name="color2" value="E31E2D"/><br>
						<button type="button"  onclick="location.reload()">OK</button><br>
					</a>
				</nav>
				<div class="row" >
					<iframe src="iframe_post.php" ></iframe>
					<div class="columnsponsor">
						<img id="pic_sponsor" src='sponsor.png'/>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


<script><!-- FRACTAL PARAMETER -->
	var Width = window.innerWidth;
	var Height = window.innerHeight;
	var HeightCanvas = Height*0.95;
	var WidthCanvas = Width*1.004;
	var texte="<canvas id=\"displayCanvas\" height=\""+HeightCanvas+"px\" width=\""+WidthCanvas+"px\" style=\"margin-left: -1%; margin-top: -1%;\">Your browser does not support HTML5 canvas.</canvas>";
	position.innerHTML = texte;
	
	function intialisation (objet_event) {
		var MyColor1 ="97D46F";
		MyColor1 = document.getElementById("SelectionColor1").value;
		MyColor1 = "#"+MyColor1;
		//alert(MyColor1);
		var MyColor2 = "0033cc";
		MyColor2=document.getElementById("SelectionColor2").value;
		MyColor2 = "#"+MyColor2;
		//alert(MyColor2);
		canvasApp(MyColor1,MyColor2);
	}
</script>