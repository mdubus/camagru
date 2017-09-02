<?PHP
session_start();
include '../../header.php';
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Mes montages</title>
</head>

<body>
	<?php
	$current_page = "montages-users";
	include '../../functions/gallery.php';
	?>
	<div class="center">
		<h2>Montages de <?PHP echo $_GET['login'];?></h2><br/><!-- securiser -->
		<div class="gallery">
			<?PHP
			$login = $_GET['login'];// securiser
			$data = get_gallery_user($login);
			$nb_values = count($data);
			if ($nb_values == 0)
			{
				echo "<p class='text'>Oh non ! Tu n'as pas encore réalisé de montage :( </p>
				<br/><p class='text'>Si tu veux en réaliser, c'est <a href='montage.php'>par ici</a></p>";
			}
			else {
				foreach ($data as $data1)
				{
					echo "<div class='photo'>";
					echo "<a href='../photo/photo.php?id_photo=".$data1['id_photo']."'><img src='../../".$data1['link']."'></a>";
					echo "</div>";
				}
				echo "</div>";
				echo "<p class='text'><a href='../gallery/gallery.php'>Revenir à la galerie</a></p>";
			}
			?>
	</div>
</body>
</html>
