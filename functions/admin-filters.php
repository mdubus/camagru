<?php
session_start();

function	get_list_filters()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `id_filter`, `path_filter` FROM `filters`");
		$requete->execute();
		$code = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($code);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	suppress_filter($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");

		$requete = $bdd->prepare("SELECT `id_filter`, `path_filter` FROM `filters`");
		$requete->execute();
		$result = $requete->rowCount();

		if ($result > 5)
		{
			$requete = $bdd->prepare("DELETE FROM `filters` WHERE `id_filter`= :id_filter");
			$requete->bindParam(':id_filter', $id);
			$requete->execute();
		}
		else {
			$_SESSION['error-delete-filter'] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	add_filter($filter)
{
	$path = "img/filtres/".$filter.".png";
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("INSERT INTO `filters` (`path_filter`)
		VALUES(:path_filter)");
		$requete->bindParam(':path_filter', $path);
		$requete->execute();

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_filter_exists($filter)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `filters` WHERE `path_filter` LIKE :name");
		$requete->bindParam(':name', $name);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_id_filter_exists($filter)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `filters` WHERE `id_filter` LIKE :filter");
		$requete->bindParam(':filter', $filter);
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
