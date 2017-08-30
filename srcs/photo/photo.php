<?PHP session_start();

if (isset($_GET['id_photo']) && $_GET['id_photo'] != NULL && is_numeric($_GET['id_photo']))
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
		$requete->bindParam(':id_photo', $_GET['id_photo']);
		$requete->execute();
		$code = $requete->rowCount();
		if ($code == 0)
		{
			header('Location: ../gallery/gallery.php');
			exit();
		}
		else {
			$_SESSION['id_photo'] = $_GET['id_photo'];
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}
else {
	header('Location: ../gallery/gallery.php');
	exit();
}
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
<link rel="stylesheet" type="text/css" href="../../css/photo.css">
<meta name="google" content="notranslate" />
<title>Photos - Camagru</title>
</head>

<body>
	<?php
	include '../../header.php';
	?>
	<div class="center">

		<?php
		include '../../functions/page-photo.php';

		$data = get_infos_user_photo($_GET['id_photo']);
		echo "<div id='id_photo'>";
		echo "<img src='".$data[0]['link']."'/>";
		echo "</div>";
		echo "<p class='text' style='text-align:center;'>Photo de <a href='../montage/montages-users.php?login=".$data[0]['login']."'>".$data[0]['login']."</a></p><br/>";
		$nb_like = get_nb_likes($_GET['id_photo']);
		$_SESSION['login-target'] = $data[0]['login'];
		?>
		<div id="like-and-comment">
			<div id="like">
				<p class="text">I like it !</p>
				<div id="like-img"><img id="like"
					<?PHP
					can_i_like_it($_GET['id_photo']);
					?>/></div>
					<p class="text" id="compteur"><?PHP echo $nb_like;?></p>
					<form method="post" name="form_photo" action="update_nb_like_photo.php" id='hidden_data_photo'>
						<input name="hidden_data_photo" type="hidden"/>
					</form>
				</div>
				<div id="post-comment">
					<form method="post" action="post-comment.php">
						<fieldset>
							<legend>Poster un commentaire</legend>
							<textarea  name="comment" maxlength="1000"></textarea>
						</fieldset>
						<input type="submit" name="submit" value="Envoyer"/>
						<?PHP
						include '../../errors.php';
						error_post_comment();
						?>
				</div>
			</div>
			<div id="list-comments">
				<?php
					$comments = get_comments($_GET['id_photo']);
					put_comments($comments);
				?>
			</div>
			<script src="photos_handle.js"></script>
		</body>



		</html>
