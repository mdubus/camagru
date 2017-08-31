<?php
session_start();
if ($_SESSION['wish-to-suppress-account'] != "OK")
{
	$_SESSION['wish-to-suppress-account'] = "OK";
	echo "<meta http-equiv='refresh' content='0,url=my-account.php'>";
}
else {
	if ($_POST['oui'] == "Oui")
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");

			$requete = $bdd->prepare("DELETE FROM `comments` WHERE `id_user`= :id_user");
			$requete->bindParam(':id_user', $_SESSION['id']);
			$requete->execute();

			$requete = $bdd->prepare("DELETE FROM `likes` WHERE `id_user`= :id_user");
			$requete->bindParam(':id_user', $_SESSION['id']);
			$requete->execute();

			$requete = $bdd->prepare("DELETE FROM `photos` WHERE `id_user`= :id_user");
			$requete->bindParam(':id_user', $_SESSION['id']);
			$requete->execute();

			$requete = $bdd->prepare("DELETE FROM `utilisateurs` WHERE `mail`= :mail");
			$requete->bindParam(':mail', $_SESSION['mail']);
			$requete->execute();
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
		$_SESSION['session-destroy'] = "OK";
		header('Location: my-account.php');
		exit();


	}
	else if ($_POST['non'] == "Non")
	{
		$_SESSION['wish-to-suppress-account'] = NULL;
		header('Location: my-account.php');
		exit();

	}
	else {
		header('Location: my-account.php');
		exit();
		
	}
}
?>
