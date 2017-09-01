<?php
session_start();

if (isset($_GET['id-photo']) && $_GET['id-photo'] != NULL && is_numeric($_GET['id-photo']))
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `id_photo` FROM `photos` WHERE `id_photo` LIKE :id_photo AND `id_user` = :id_user");
		$requete->bindParam(':id_photo', $_GET['id-photo']);
		$requete->bindParam(':id_user', $_SESSION['id']);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result == 0)
		{
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		else {
			$requete = $bdd->prepare("DELETE FROM `photos` WHERE `id_photo`= :id_photo");
			$requete->bindParam(':id_photo', $_GET['id-photo']);
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
	echo "<meta http-equiv='refresh' content='0,url=../montage/montages-users.php?login=".$_SESSION['login']."'>";

 ?>
