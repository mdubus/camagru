<?php

function connexion_check_password($mail, $password)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `mail` LIKE :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$code = $requete->fetch(PDO::FETCH_ASSOC);
		if (in_array($password, $code) == TRUE)
		{
			$_SESSION['connexion-good-password'] = "OK";
			return ($code);
		}
		else {
			$_SESSION['connexion-good-password'] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function send_reinit_password_mail($token, $mail, $submit)
{
	$name = "Camagru";
	$message = "Cher membre" . ",\r\n\r\n" .
	"Tu as oublié ton mot de passe et nous en sommes désolés.\r\n\r\n" .
	"Voici le lien qui te permettra de réinitialiser ce dernier : \r\n\r\n" .
	"http://localhost:8080/camagru/srcs/reset-password/reset-my-password.php?token=".$token." \r\n\r\n" .
	"À bientôt !";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Réinitialisation du mot de passe sur camagru.fr', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";
	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

function	get_nb_likes_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `likes`.`id_photo` AS `id_photo`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			ORDER BY `likes`.`id_photo` ASC");
			$requete->bindParam(':id', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_most_liked_picture($id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_likes`
			FROM `likes`
			INNER JOIN `photos` ON `photos`.`id_photo` = `likes`.`id_photo`
			WHERE `photos`.`id_user` = :id
			GROUP BY `photos`.`id_photo`
			ORDER BY `nb_likes` DESC");
			$requete->bindParam(':id', $id);
			$requete->execute();
			$result = $requete->fetchAll(PDO::FETCH_ASSOC);
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}


	}

	function	get_nb_comments_user($id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT `photos`.`link`, `photos`.`id_user` AS `Uploader`, `comments`.`id_photo` AS `id_photo`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				ORDER BY `comments`.`id_photo` ASC");
				$requete->bindParam(':id', $id);
				$requete->execute();
				$result = $requete->rowCount();
				return ($result);
			}
			catch (PDOException $e) {
				print "Erreur : ".$e->getMessage()."<br/>";
				die();
			}
		}

		function	get_most_commented_picture($id)
		{
			try{
				include '../../config/database.php';
				$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$bdd->query("USE camagru");
				$requete = $bdd->prepare("SELECT `photos`.`id_photo`, `photos`.`link`, COUNT(*) as `nb_comments`
				FROM `comments`
				INNER JOIN `photos` ON `photos`.`id_photo` = `comments`.`id_photo`
				WHERE `photos`.`id_user` = :id
				GROUP BY `photos`.`id_photo`
				ORDER BY `nb_comments` DESC");
				$requete->bindParam(':id', $id);
				$requete->execute();
				$result = $requete->fetchAll(PDO::FETCH_ASSOC);
				return ($result);
			}
			catch (PDOException $e) {
				print "Erreur : ".$e->getMessage()."<br/>";
				die();
			}


		}
function	check_old_pass($old_pass, $flag)
{

	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `mdp` FROM `utilisateurs` WHERE `id` LIKE :id");
		$requete->bindParam(':id', $_SESSION['id']);
		$requete->execute();
		$code = $requete->fetch(PDO::FETCH_ASSOC);
		// print_r ($code);
		if ($old_pass == $code['mdp'])
		{
			$_SESSION[$flag] = "OK";
			return ($code);
		}
		else {
			$_SESSION[$flag] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}


 ?>
