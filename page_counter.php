<!-- SOCIALDEVICES V2.4 2018 - PopUp returnZero Page -->
<!doctype html>
<html>
	<meta charset="utf-8"/>
	<title>Counter</title>
	
	<!--LIENS-->
	<script src="function.js"></script>
	<link rel="stylesheet" href="style_popup.css"/>
	<!--------->
	
	<header>-COUNTER-</header>
	<p>
		Le compteur de tweet va être réinitialisé à Zéro. Continuer ?<br><br>
		<button onclick="<?php
			$File = fopen('Counter.txt','w+');
			fseek($File,0);
			$variable = '0t';
			fputs($File, $variable);
			fclose($File);
		?>">OUI</button>
		<button onclick="CloseWindows()">Quitter</button>
	</p>
</html>
