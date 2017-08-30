<?PHP session_start();

include "../../functions/reset-password.php";
include "../../functions/inscription.php";

$mail = htmlentities($_POST['mail']);
$password1 = htmlentities($_POST['password1']);
$password2 = htmlentities($_POST['password2']);
$token = htmlentities($_POST['token']);

$return = check_exists_mail($mail);
$_SESSION['flag-mail-exists-reset-my-password'] = ($return > 0) ? "OK" : "KO";

check_form("reset", "password1", $password1);
check_form("reset", "password2", $password2);
check_regex_password($password1, "reset-flag-regex-password");
check_same_password($password1, $password2, "reset-same-password");


if ($_SESSION['flag-mail-exists-reset-my-password'] == "OK" &&
$_SESSION['reset-password1'] == "OK" && $_SESSION['reset-password2'] == "OK" &&
$_SESSION['reset-flag-regex-password'] == "OK" &&
$_SESSION['reset-same-password'] == "OK")
{
	check_token_reset_password($password1, $token, $mail);
	if ($_SESSION['reset-good-token'] == "OK"){
		$new_password = hash('sha512', $password1);

		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("UPDATE `utilisateurs` SET `mdp` = :new_password, `token` = NULL WHERE `mail` LIKE :mail");
			$requete->bindParam(':new_password', $new_password);
			$requete->bindParam(':mail', $mail);
			$requete->execute();
			$_SESSION['reinit-password-in-db'] = "OK";

		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}

		echo "<meta http-equiv='refresh' content='0,url=reset-my-password.php'>";

	}

}
	echo "<meta http-equiv='refresh' content='0,url=reset-my-password.php?token=".$token."'>";
?>
