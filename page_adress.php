<!-- SOCIALDEVICES V2.5 2018 - PopUp Facebook Option Page -->
<!-- Author : clbouchier -->
<!doctype html>
<html><meta charset="utf-8"/><!-- for specials caracters -->
	<head>
		<title>SocialDevices - Likes</title><!-- tab title -->
		<!-- LINK -->
		<script src="function.js"></script>
		<link rel="stylesheet" href="style_popup.css"/>
	</head>
	
	<header>- PARAMETRE ADRESSE FACEBOOK -</header>
	
	<?php
		if(!empty($_POST['Adress'])){//If there is a new choice of facebook page (launch with ENTER touch)
			$File = fopen('Facebook.txt','w+');//open as write/read, cursor at the begining and crush creation
			$variable = $_POST["Adress"];//get variable from the form
			fputs($File, $variable);//write it in the file
			echo '<p>Nouvelle Adresse → '. $variable.'</p>';//display the new choice
			fclose($File);
		}
	?>
	<p>
		<u>Choisir la page Facebook : </u>
		<form method="POST"><input type="texte" name="Adress" value="<?php
				$File = fopen('Facebook.txt','r');//open as read only
				$value = fgets($File);//get what's in the file facebook.txt
				echo $value;//put it like default value on the form
				fclose($File);
		?>"/>
	</p>
</html>
