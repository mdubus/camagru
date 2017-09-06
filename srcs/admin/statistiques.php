<?PHP session_start();
if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
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
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<meta name="google" content="notranslate" />
<title>Statistiques - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "admin";
	include '../../header.php';
	include '../../functions/statistiques.php';

	$nb_users = get_nb_users();
	$nb_photos = get_nb_photos();
	$nb_comments = get_nb_comments();
	$nb_like = get_nb_like();

	$most_liked_user = get_most_liked_user();
	$max_like_user = $most_liked_user[0]['nb_likes'];
	foreach ($most_liked_user as $elem)
	{
		if ($elem['nb_likes'] == $max_like_user)
		$array_like[] = $elem;
	}

	$most_commented_user = get_most_commented_user();
	$max_commented_user = $most_commented_user[0]['nb_comments'];
	foreach ($most_commented_user as $elem2)
	{
		if ($elem2['nb_comments'] == $max_commented_user)
		$array_comment[] = $elem2;
	}

	$most_photo_user = get_most_photo_user();
	$max_photo_user = $most_photo_user[0]['nb_photos'];
	foreach ($most_photo_user as $elem3)
	{
		if ($elem3['nb_photos'] == $max_photo_user)
		$array_photos[] = $elem3;
	}

	$most_liked_photo = get_most_liked_photo();
	$max_like_photo = $most_liked_photo[0]['nb_likes_photo'];
	foreach ($most_liked_photo as $elem4)
	{
		if ($elem4['nb_likes_photo'] == $max_like_photo)
		$array_like_photo[] = $elem4;
	}

	$most_commented_photo = get_most_commented_photo();
	$max_commented_photo = $most_commented_photo[0]['nb_comments_photo'];
	foreach ($most_commented_photo as $elem5)
	{
		if ($elem5['nb_comments_photo'] == $max_commented_photo)
		$array_comment_photo[] = $elem5;
	}

	echo '<div class="center">';
		echo "<h2>Statistiques</h2><br/>";

		echo "<h3>Généralités</h3>";
		echo "<p class='text'>Nombre d'utilisateurs : ".$nb_users."</p>";
		echo "<p class='text'>Nombre de montages : ".$nb_photos."</p>";
		echo "<p class='text'>Nombre de commentaires : ".$nb_comments."</p>";
		echo "<p class='text'>Nombre de likes : ".$nb_like."</p>";
		echo "<br/>";

		echo "<h3>Utilisateurs</h3>";

		echo "<p class='text'>Utilisateur le plus liké : ";
		if ($array_like == NULL)
		{
			echo "Aucun";
		}
		else {
		foreach ($array_like as $like)
		{
			echo "<a href='../montage/montages-users.php?login=".$like['login']."'>".$like['login']."</a>";
			echo " (".$like['nb_likes']." likes)";
			echo "<br/>";
		}
		echo "</p>";
		}


		echo "<p class='text'>Utilisateur le plus commenté : ";
		if ($array_comment == NULL)
		{
			echo "Aucun";
		}
		else {
		foreach ($array_comment as $comment)
		{
			echo "<a href='../montage/montages-users.php?login=".$comment['login']."'>".$comment['login']."</a>";
			echo " (".$comment['nb_comments']." commentaires)";
			echo "<br/>";
		}
		echo "</p>";
		}

		echo "<p class='text'>Utilisateur avec le plus de photos : ";
		if ($array_photos == NULL)
		{
			echo "Aucun";
		}
		else {
		foreach ($array_photos as $photo)
		{
			echo "<a href='../montage/montages-users.php?login=".$photo['login']."'>".$photo['login']."</a>";
			echo " (".$photo['nb_photos']." photos)";
			echo "<br/>";
		}
		echo "</p>";
		}
		echo "<br/>";

		echo "<h3>Montages</h3>";
		echo "<p class='text'>Montage le plus liké : ";
		if ($array_like_photo == NULL)
		{
			echo "Aucun";
		}
		else {
		foreach ($array_like_photo as $like_photo)
		{
			echo "<a href='../photo/photo.php?id_photo=".$like_photo['id_photo']."'>Clique ici</a>";
			echo " (".$like_photo['nb_likes_photo']." likes)";
			echo "<br/>";
		}
		echo "</p>";
		}


		echo "<p class='text'>Montage le plus commenté : ";
		if ($array_comment_photo == NULL)
		{
			echo "Aucun";
		}
		else {
		foreach ($array_comment_photo as $comment_photo)
		{
			echo "<a href='../photo/photo.php?id_photo=".$comment_photo['id_photo']."'>Clique ici</a>";
			echo " (".$comment_photo['nb_comments_photo']." commentaires)";
			echo "<br/>";
		}
		echo "</p>";
		}
		?>



	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
