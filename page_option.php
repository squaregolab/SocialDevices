<!-- SOCIALDEVICES V2.4 2018 - PopUp OptionPage -->
<!doctype html>
<html>
	<meta charset="utf-8"/>
	<title>option</title>
	
	<!--LIENS-->
	<script src="function.js"></script>
	<link rel="stylesheet" href="style_popup.css"/>
	<!--------->
	
	<header>-PARAMETRE-</header>
	
	<?php
		if(!empty($_POST['Filter'])){//If there is a new choice, Hastag, send.
			$File = fopen('Filter.txt','w+');//open as write/read, cursor at the begining, crush creation
			$variable = $_POST["Filter"];
			fputs($File, $variable);//write the choice in the file
			echo '<p>Nouveau Filtre → '. $variable.'</p>';
			fclose($File);
		}
	?>
	<p>
		<u>Filtre : </u>
		<form method="POST"><input type="texte" name="Filter" value="<?php
				$File = fopen('Filter.txt','r');//open as read only
				$value = fgets($File);//get what's in the file (previous hashtag)
				echo $value;//put previous hashtag like default value
				fclose($File);
		?>"/>
	</p>
	
</html>
