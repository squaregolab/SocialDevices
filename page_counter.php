<!-- SOCIALDEVICES V2.5 2018 - PopUp ReturnZero TweetNumber Page -->
<!doctype html>
<html><meta charset="utf-8"/><!-- for specials caracters -->
	<head>
		<title>SocialDevices - Counter</title><!-- tab title -->
		<!-- LINK -->
		<script src="function.js"></script>
		<link rel="stylesheet" href="style_popup.css"/>
	</head>
	
	<header>- COMPTER DE TWEET -</header>
	
	<p>
		Le compteur de tweet va être réinitialisé à Zéro. Continuer ?<br><br>
		<button onclick="<?php
			$File = fopen('Counter.txt','w+');//open as write/read, cursor at the begining and crush creation
			$variable = '0t';
			fputs($File, $variable);//replace data in the file by zero
			fclose($File);
		?>">OUI</button>
		<button onclick="CloseWindows()">Quitter</button>
	</p>
</html>
