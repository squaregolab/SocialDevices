<!--SOCIALDEVICES V2.4 2018 -->
<!DOCTYPE html>

<html><meta charset="UTF-8"/>
	<head>
		<!-- LINK -->
		<link rel="stylesheet" href="style_iframe.css"/>
		<!-- ---- -->
		<title>SocialDevices iframe</title>
	</head>
	<body id="RefreshDiv">
		<div class="columnposts">
			<?php
				$xml=simplexml_load_file('data_posts.xml') or die('Error: Cannot open data file');
				for($i=0; $i<20; $i++){//loop for the 20 last posts on the datafile
					if ($xml->post[$i] == true){//if there is a post
						echo "<div class='element_post' >";//strat design of tweet post
						echo "<h_post>";
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
						echo "</div>";//stop design of tweet post
					}
				}
			?>
		</div>
    </body>
</html><!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
	var auto_refresh = setInterval(
	function (){
		$(RefreshDiv).load('iframe_post.php').fadeIn(milliseconds);
	}, 10000);
</script><!-- This eatch 10 secondes -->