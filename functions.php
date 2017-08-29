<?php

// Inscription

function check_form($flag, $text, $data)
{
	if (isset($data) && $data != NULL)
	{
		$_SESSION[$flag."-".$text] = "OK";
	}
	else
	{
		$_SESSION[$flag."-".$text] = "KO";
	}
}

function check_regex_mail($data)
{
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == FALSE)
	{
		$_SESSION['flag-regex-mail'] = "KO";
	}
	else {
		$_SESSION['flag-regex-mail'] = "OK";
	}
}

function check_regex_password($data, $flag)
{
	if (preg_match("/(?=.{6,})(?=.*\d)(?=.*[a-zA-Z])/", $data) != 1)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function check_exists_username($identifiant)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `login`= :login");
		$requete->bindParam(':login', $identifiant);
		$requete->execute();
		$result = $requete->rowCount();
		if ($result  > 0){
			$_SESSION['flag-user-exists'] = "KO";
		}
		else {
			$_SESSION['flag-user-exists'] = "OK";
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_exists_mail($mail)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `mail`= :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function check_same_password($pass1, $pass2, $flag)
{
	if ($pass1 != $pass2)
	{
		$_SESSION[$flag] = "KO";
	}
	else {
		$_SESSION[$flag] = "OK";
	}
}

function send_confirmation_mail($identifiant, $mail)
{
	$name = "Camagru";
	$message = "Cher " . $identifiant . ",\r\n\r\n" .
	"Merci de t'être inscris sur Camagru.fr\r\n\r\n" .
	"Tu peux dès à présent te connecter sur notre site\r\n\r\n" .
	"À bientôt !";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = 'Ton inscription sur camagru.fr';
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";

	if ($_POST['submit'])
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

// Connexion

function connexion_check_password($mail, $password)
{
	try{
		include '../config/database.php';
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
	"http://localhost:8080/camagru/reset-password/reset-my-password.php?token=".$token." \r\n\r\n" .
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

// Reset password

function	check_token_reset_password($password1, $token, $mail)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `mail`= :mail");
		$requete->bindParam(':mail', $mail);
		$requete->execute();
		$code = $requete->fetch(PDO::FETCH_ASSOC);
		if (in_array($token, $code) == TRUE)
		$_SESSION['reset-good-token'] = "OK";
		else {
			$_SESSION['reset-good-token'] = "KO";
		}
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_gallery_data()
{
	try{
		include '../config/database.php';
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
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `photos` INNER JOIN `utilisateurs` ON utilisateurs.id = photos.id_user WHERE `login` LIKE :login");
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


// PHOTO

function	get_infos_user_photo($id_photo)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `link`, `login`, `mail` FROM `photos` INNER JOIN `utilisateurs` ON utilisateurs.id = photos.id_user WHERE `id_photo` LIKE :id_photo");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->execute();
		$data = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_nb_likes($id_photo)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `likes` WHERE `id_photo`= :id_photo");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}



function	check_if_already_liked($id_photo, $id)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `likes` INNER JOIN `utilisateurs` ON utilisateurs.id = likes.id_user WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->bindParam(':id_user', $id);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_my_photo($id_photo, $id)
{
	try{
		include '../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->bindParam(':id_user', $id);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	can_i_like_it($id_photo)
{
	if (isset($_SESSION['login']))
	{
	 $already_liked = check_if_already_liked($id_photo, $_SESSION['id']);
	 $my_photo = check_if_my_photo($_GET['id_photo'], $_SESSION['id']);
		if ($already_liked != 0 || $my_photo != 0)
		{
			echo 'src="../img/paw-grey.png"';
			if ($already_liked != 0)
				echo 'title="Vous aimez déjà cette image !"';
			else if ($my_photo != 0)
				echo 'title="Vous ne pouvez pas aimer votre image !"';
		}
		else {
		echo 'src="../img/paw-black.png"';
		echo 'onmouseover="this.src=\'../img/paw-pink.png\'"';
		echo 'onmouseout="this.src=\'../img/paw-black.png\'"';
		echo 'onclick="increment_like()"';
		}
	}
	else {
		echo 'src="../img/paw-grey.png"';
	}
}

?>
