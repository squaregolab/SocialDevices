<!-- SOCIALDEVICES V2.5 2018 - PopUp OptionPage -->
<!-- Author : clbouchier -->
<!doctype html>
<html><meta charset="utf-8"/><!-- for specials caracters -->
	<head>
		<title>SocialDevices - Filter</title><!-- tab title -->
		<!-- LINK -->
		<script src="function.js"></script>
		<link rel="stylesheet" href="style_popup.css"/>
	</head>
	
	<header>- PARAMETRE DU FILTRE -</header>
	
	<?php
		if(!empty($_POST['Filter'])){//If there is a new choice of filter (launch with ENTER touch)
			$File = fopen('Filter.txt','w+');//open as write/read, cursor at the begining and crush creation
			$variable = $_POST["Filter"];//get variable from the form
			fputs($File, $variable);//write the choice in the file
			echo '<p>Nouveau Filtre → '. $variable.'</p>';//display the new choice
			fclose($File);
		}
	?>
	<p>
		<u>Filtre : </u>
		<form method="POST"><input type="texte" name="Filter" value="<?php
				$File = fopen('Filter.txt','r');//open as read only
				$value = fgets($File);//get what's in the file Filter.txt
				echo $value;//put it like default value on the form
				fclose($File);
		?>"/>
	</p>
	
</html>
