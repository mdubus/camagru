<?php
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
		include '../../config/database.php';
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
		include '../../config/database.php';
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

function send_confirmation_mail($identifiant, $mail, $submit)
{
	$name = "Camagru";
	$message = "Cher " . $identifiant . ",\r\n\r\n" .
	"Merci de t'être inscris sur Camagru.fr\r\n\r\n" .
	"Tu peux dès à présent te connecter sur notre site à l'adresse suivante : \r\n\r\n" .
	"http://localhost:8080/camagru/srcs/connexion/connexion.php \r\n\r\n" .
	"À bientôt !";
	$from = 'From: Camagru';
	$to = $mail;
	$subject = mb_encode_mimeheader('Ton inscription sur camagru.fr', "UTF-8");
	$body = "From: $name\r\nTo: $to\r\nMessage:\r\n\r\n$message";

	if ($submit)
	{
		if (mail ($to, $subject, $body, $from) == FALSE)
		{
			die();
		}
	}
}

 ?>
