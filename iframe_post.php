<!-- SOCIALDEVICES V3.0 2018
 Author : clbouchier-->
<div class="columnposts">
	<?php
		$xml=simplexml_load_file('data_posts.xml') or die('Error: Cannot open data file');//Load data file
		for($i=0; $i<20; $i++){//loop for the 20 last <post> in the datafile
			if ($xml->post[$i] == true){//if there is a post (in case there'r less than 20)
				echo "<div class='element_post' >";//--- start design of tweet post
				echo "<h_post>";//for design of user name
				if ($xml->post[$i]->pic_avatar == true){
					echo "<img id='picture_avatar' src='";
					echo $xml->post[$i]->pic_avatar."'/>";
				}
				echo "         ";
				echo $xml->post[$i]->user_name . "</h_post><br>";
				echo $xml->post[$i]->text . "<br>";
				if ($xml->post[$i]->pic_media == true){
					echo "<img id='picture_media' src='";
					echo $xml->post[$i]->pic_media."'/><br>";
				}
				echo "<p_date>";
				echo $xml->post[$i]->created_at."</p_date>";
				echo "</div>";//--- stop design of tweet post
			}
		}
	?>
</div>
