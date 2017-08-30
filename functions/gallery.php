<?php

	function	get_gallery_data()
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos` ORDER BY `date_upload` DESC");
			$requete->execute();
			$data = $requete->fetchAll();
			return ($data);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_gallery_user($login)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos` INNER JOIN `utilisateurs` ON utilisateurs.id = photos.id_user WHERE `login` LIKE :login ORDER BY `date_upload` DESC");
			$requete->bindParam(':login', $login);
			$requete->execute();
			$data = $requete->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}
 ?>
