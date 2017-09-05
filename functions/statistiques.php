<?php

function	get_nb_users()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `login` != 'admin'");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_photos()
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

function	get_nb_comments()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `comments`");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_like()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `likes`");
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_liked_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `utilisateurs`.`login`, COUNT(*) as `nb_likes`
		FROM `utilisateurs`
		INNER JOIN `photos` ON `photos`.`id_user` = `utilisateurs`.`id`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `utilisateurs`.`id`
		ORDER BY `nb_likes` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_commented_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `utilisateurs`.`login`, COUNT(*) as `nb_comments`
		FROM `utilisateurs`
		INNER JOIN `photos` ON `photos`.`id_user` = `utilisateurs`.`id`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `utilisateurs`.`id`
		ORDER BY `nb_comments` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_photo_user()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `utilisateurs`.`login`, COUNT(*) as `nb_photos`
		FROM `utilisateurs`
		INNER JOIN `photos` ON `photos`.`id_user` = `utilisateurs`.`id`
		GROUP BY `utilisateurs`.`id`
		ORDER BY `nb_photos` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}


function	get_most_liked_photo()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_likes_photo`
		FROM `photos`
		INNER JOIN `likes` ON `likes`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_likes_photo` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_most_commented_photo()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `photos`.`id_photo`, COUNT(*) as `nb_comments_photo`
		FROM `photos`
		INNER JOIN `comments` ON `comments`.`id_photo` = `photos`.`id_photo`
		GROUP BY `photos`.`id_photo`
		ORDER BY `nb_comments_photo` DESC");
		$requete->execute();
		$result = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}












 ?>
