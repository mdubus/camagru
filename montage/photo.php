<?PHP session_start();
// securiser contre les lettres, les chiffres negatifs, etc
if (!(isset($_GET['id_photo'])) || $_GET['id_photo'] == NULL)
echo "<meta http-equiv='refresh' content='0,url=../index.php'>";
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../css/global.css">
<link rel="stylesheet" type="text/css" href="../css/header.css">
<link rel="stylesheet" type="text/css" href="../css/photo.css">
<meta name="google" content="notranslate" />
<title>Photos - Camagru</title>
</head>

<body>
	<?php
	include '../header.php';
	?>
	<div class="center">

		<?php
		include '../functions.php';

		$data = get_infos_user_photo($_GET['id_photo']);
		echo "<div id='id_photo'>";
		echo "<img src='".$data[0]['link']."'/>";
		echo "</div>";
		echo "<p class='text' style='text-align:center;'>Photo de <a href='montages-users.php?login=".$data[0]['login']."'>".$data[0]['login']."</a></p><br/>";
		$nb_like = get_nb_likes($_GET['id_photo']);
		?>
		<div id="like-and-comment">
			<div id="like">
				<p class="text">I like it !</p>
				<div id="like-img"><img id="like"
					<?PHP
					can_i_like_it($_GET['id_photo']);
					?>/></div>
					<p class="text" id="compteur"><?PHP echo $nb_like;?></p>
					<!-- <form method="post" action="check-inscription.php" id="form-nb-like" type="hidden">
						<button id='submit-nb-like' type="hidden"></button>
					</form> -->
				</div>
				<div id="comment">

				</div>
			</div>

			<script src="photos_handle.js"></script>
		</body>



		</html>
