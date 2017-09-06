<?php
session_start();

if (isset($_GET['id-comment']) && $_GET['id-comment'] != NULL && is_numeric($_GET['id-comment']))
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `id_comment` FROM `comments` WHERE `id_comment` LIKE :id_comment AND `id_user` LIKE :id_user");
		$requete->bindParam(':id_comment', $_GET['id-comment']);
		$requete->bindParam(':id_user', $_SESSION['id']);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result == 0)
		{
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		else {
			$requete = $bdd->prepare("DELETE FROM `comments` WHERE `id_comment`= :id_comment");
			$requete->bindParam(':id_comment', $_GET['id-comment']);
			$requete->execute();
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}
else {
	header('Location: photo.php?id_photo='.$_SESSION['id_photo']);
	exit();
}
	echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";

 ?>
