<?php
session_start();

if ($_SESSION['click-like'] != "OK")
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}
else {
	include '../../functions/page-photo.php';
	$_SESSION['liked'] = check_if_already_liked($_SESSION['id_photo'], $_SESSION['id']);
	if ($_SESSION['liked'] == 0)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("INSERT INTO `likes` (`id_user`, `id_photo`)
			VALUES (:id_user, :id_photo);");
			$requete->bindParam(':id_photo', $_SESSION['id_photo']);
			$requete->bindParam(':id_user', $_SESSION['id']);
			$requete->execute();
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}
}
?>
