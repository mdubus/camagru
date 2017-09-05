<?php

	function	get_gallery_data($page)
	{
		$offset = ($page - 1) * 10;
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos` ORDER BY `date_upload` DESC LIMIT 10 OFFSET :offs");
			$requete->bindParam(':offs', $offset, PDO::PARAM_INT);
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

	function	get_nb_montages()
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos`");
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_login_exists($login)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `login` = :login");
			$requete->bindParam(':login', $login);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}
 ?>
