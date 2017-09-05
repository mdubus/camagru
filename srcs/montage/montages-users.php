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

			<?PHP
			$exists_or_not = check_if_login_exists($_GET['login']);
			if ($exists_or_not == 0)
			{
				echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php'>";
			}
			else {
					$login = $_GET['login'];
					echo "<h2>Montages de ".$login."</h2><br/>";
					echo '<div class="gallery">';
					$data = get_gallery_user($login);
					$nb_values = count($data);
					if ($nb_values == 0)
					{
						if ($_SESSION['login'] == $login)
						{
						echo "<p class='text'>Oh non ! Tu n'as pas encore réalisé de montage :( </p>
						<br/><p class='text'>Si tu veux en réaliser, c'est <a href='montage.php'>par ici</a></p>";
						}
						else {
							echo "<p>".$login." n'a pas encore réalisé de montage :(</p>";
						}
					}
					else {
						foreach ($data as $data1)
						{
							echo "<div class='photo'>";
							echo "<a href='../photo/photo.php?id_photo=".$data1['id_photo']."'><img src='../../".$data1['link']."'></a>";
							echo "</div>";
						}
						echo "</div>";
					}
			}
				echo "</div>";
			?>

</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
