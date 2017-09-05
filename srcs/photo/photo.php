<?PHP session_start();
include '../../functions/page-photo.php';
include '../../header.php';
check_if_picture_exists($_GET['id_photo']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="google" content="notranslate" />
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/photo.css">
<link rel="stylesheet" type="text/css" href="../../css/my-account.css">
<meta name="google" content="notranslate" />
<title>Photos - Camagru</title>
</head>

<body>
	<div class="center">

		<?php

		$data = get_infos_user_photo($_GET['id_photo']);
		echo "<div id='id_photo'>";
		echo "<img src='../../".$data[0]['link']."'/>";

		echo "</div>";



		echo "<p class='text' style='text-align:center;'>Photo de <a href='../montage/montages-users.php?login=".$data[0]['login']."'>".$data[0]['login']."</a></p>";
		$result = picture_belong_to_user($_GET['id_photo']);
		if ($result > 0 || $_SESSION['groupe'] == 'admin')
		{
			echo "<a href='delete-picture.php?id-photo=".$_GET['id_photo']."' id='delete-picture' class='fake-link'>Supprimer cette photo</a><br/>";
		}

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
		</div>
			<script src="photos_handle.js"></script>
		</body>

		<?php
		include '../../footer.php';
		 ?>

		</html>
