<?PHP session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
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
<meta name="google" content="notranslate" />
<title>Mon compte - Camagru</title>
</head>

<body>
	<?php
	$current_page = "my-account";
	include '../../header.php';
	?>
	<div class="center">
		<h2>Bienvenue <?PHP echo $_SESSION['login'];?></h2>
		<br/><br/>
		<h3>Statistiques</h3>

		<?php
		include '../../functions/connexion.php';
		include '../../functions/gallery.php';

		$gallery_user = get_gallery_user($_SESSION['login']);
		if ($gallery_user == NULL)
		{
			$_SESSION['nb_montages'] = 0;
			echo "<p class='text'>Tu n'as pas encore réalisé de montage :(</p>";
			echo "<p class='text'>Si tu souhaites en faire, c'est <a href='../montage/montage.php'>par ici !</a></p>";
		}
		else
		{
			echo '<p class="text"> Nombre de like sur mes montages : ';
			$nb_likes = get_nb_likes_user($_SESSION['id']);
			echo $nb_likes;
			echo "</p>";
			echo '<p class="text"> Mon montage le plus liké : ';
			$most_liked_picture = get_most_liked_picture($_SESSION['id']);
			if ($most_liked_picture == NULL)
			{
				echo "Aucun :(";
			}
			else {
				echo "<br/><br/>";
				$max = $most_liked_picture[0]['nb_likes'];
				foreach ($most_liked_picture as $elem)
				{
					if ($elem['nb_likes'] == $max)
					$array_like[] = $elem;
				}
				foreach ($array_like as $photo_like)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Clique ici</a> (".$max." likes)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_like['id_photo']."'>Clique ici</a> (".$max." like)<br/>";
					}
				}
			}


			echo "</p><br/>";


			echo '<p class="text"> Nombre de commentaires sur mes montages : ';
			$nb_comments = get_nb_comments_user($_SESSION['id']);
			echo $nb_comments;
			echo "</p>";
			echo '<p class="text"> Mon montage le plus commenté : ';
			$most_commented_picture = get_most_commented_picture($_SESSION['id']);
			if ($most_commented_picture == NULL)
			{
				echo "Aucun :(";
			}
			else {
				echo "<br/><br/>";
				$max = $most_commented_picture[0]['nb_comments'];
				foreach ($most_commented_picture as $elem)
				{
					if ($elem['nb_comments'] == $max)
					{
					$array_comments[] = $elem;
					}
				}
				foreach ($array_comments as $photo_comment)
				{
					if ($max > 1)
					{
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Clique ici</a> (".$max." commentaires)<br/>";
					}
					else {
						echo "<a href='../photo/photo.php?id_photo=".$photo_comment['id_photo']."'>Clique ici</a> (".$max." commentaire)<br/>";
					}
				}
			}
			echo "<br/><br/>";

			echo '<p class="text"><a href="../montage/montages-users.php?login='.$_SESSION['login'].'"> Voir tous mes montages</a></p>';

		}
		echo "<br/>"

		?>
		<br/>
		<h3>Gérer mon compte</h3><br/>
		<p class="text"><a href="#">Changer mon mot de passe</a></p>
		<p class="text"><a href="#">Changer mon adresse mail</a></p>
		<p class="text"><a href="suppress-account.php">Supprimer mon compte</a></p>

		<?PHP
		if ($_SESSION['wish-to-suppress-account'] == "OK")
		{
			echo "<p class='text'>Souhaites-tu vraiment supprimer ton compte ?</p>";
			echo "<form method='post' action='suppress-account.php'>";
			echo "<input type='submit' name='oui' value='Oui'/>\t";
			echo "<input type='submit' name='non' value='Non'/><br/><br/>";
			echo "</form><br/><br/>";

		}
		if ($_SESSION['session-destroy'] == "OK")
		{
			echo "<div id='inscription-ko'><p>Ton compte a bien été supprimé.</p>";
			echo "<p>Tu vas être redirigé vers l'accueil dans 5 secondes.</p></div>";
			session_destroy();
			echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
		}
		?>



	</div>
</body>
</html>
