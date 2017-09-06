<?PHP session_start();

	include "../../functions/reset-password.php";
	include "../../functions/inscription.php";
	include "../../functions/connexion.php";

	$mail = htmlentities($_POST['mail']);

	$return = check_exists_mail($mail);
	if ($return > 0)
	{
		$_SESSION['flag-reset-password-mail-exists'] = "OK";
	}
	else {
		$_SESSION['flag-reset-password-mail-exists'] = "KO";
	}

	if ($_SESSION['flag-reset-password-mail-exists'] == "OK")
	{
		$token = bin2hex(random_bytes(64));

		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("UPDATE `utilisateurs` SET `token` = :token WHERE `mail` LIKE :mail");
			$requete->bindParam(':token', $token);
			$requete->bindParam(':mail', $mail);
			$requete->execute();

			send_reinit_password_mail($token, $mail, $_POST['submit']);
			$_SESSION['mail-reinit-password'] = "OK";

		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
		echo "<meta http-equiv='refresh' content='0,url=reset-password.php'>";
	}
	else {
		echo "<meta http-equiv='refresh' content='0,url=reset-password.php'>";
		exit();
	}



?>
