<!-- SOCIALDEVICES V3.0 2018 - Main Page -->
<!-- Author : clbouchier -->
<!DOCTYPE html>
<html><meta charset="UTF-8"/><!-- for specials caracters -->
	<head>
		<title>SocialDevices</title><!-- tab title -->
		<!-- LINK -->
		<link rel="stylesheet" href="style_screen.css"/>
		
		<script src="function.js"></script><!-- menu's functions -->
		<script src="modernizr-2.js"></script><!-- for fractal and canvas -->
		<script src="fractal.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>	
	</head>

	<body onload="intialisation(event)">
		<div class="overlay"><!-- Overlay -->
			<div class="overlay_down"><!-- OverlayDown : Fractal -->
				<div class="containe">
					<div id="position"><!-- Canvas position --></div>
					<a id="btnRegenerate" value="regenerate"></a>
					<a id="btnExport" value="export image (png)"></a>
				</div>
			</div>
			<div class="overlay_middle">
				<div id="RefreshDiv"><!-- data from iframe_post.php --></div>
			</div>
			<div class="overlay_up"><!-- OverlayUp :  Menu and sponsors -->
				<nav id="mySidenav" class="sidenav">
					<a id="filter" onclick="open_option_filter()">Filter</a>
					<a id="adress" onclick="open_option_adress()">Adress</a>
					<a id="counter" onclick="open_option_counter()">Counter</a>
					<a id="design">
						#Color1<input class="inputcolor" id="SelectionColor1" type="text" name="color1" value="00BEE1"/><br><!-- ask for color 1 -->
						#Color2<input class="inputcolor" id="SelectionColor2" type="text" name="color2" value="E31E20"/><br><!-- ask for color2 -->
						<button type="button"  onclick="location.reload()">OK</button><br><!-- reload page for color's motification to be make -->
					</a>
				</nav>
				<div class="columnsponsor">
					<img id="pic_sponsor" src='sponsor.png'/>
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
	position.innerHTML = texte;//display fractal at position
	
	function intialisation (objet_event) {
		var MyColor1 ="97D46F";//default color1
		MyColor1 = document.getElementById("SelectionColor1").value;
		MyColor1 = "#"+MyColor1;//concatenate
		var MyColor2 = "0033cc";//default color2
		MyColor2=document.getElementById("SelectionColor2").value;
		MyColor2 = "#"+MyColor2;
		canvasApp(MyColor1,MyColor2);//colors send to fractal.js's function
	}
</script>
<script type="text/javascript">
	$.get("iframe_post.php",function(data){//get of the data, the one iframe_post.php creat
		$("#RefreshDiv").html(data);//put in the RefreshDiv position the row data from iframe_post.
	});//load a first time the posts
	var auto_refresh = setInterval(
	function (){
		$.get("iframe_post.php",function(data){//get of the data, the one iframe_post.php creat
			$("#RefreshDiv").html(data);//put in the RefreshDiv position the row data from iframe_post.
		});
	}, 5000);//then reload posts eatch 5 seconds.
</script>
