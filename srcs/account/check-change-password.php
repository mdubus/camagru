<?PHP session_start();
include '../../functions/connexion.php';
include '../../functions/inscription.php';

check_form("change-pass", "old_pass", $_POST['old_pass']);
check_form("change-pass", "pass1", $_POST['pass1']);
check_form("change-pass", "pass2", $_POST['pass2']);

if ($_SESSION['change-pass-old_pass'] == "OK" && $_SESSION['change-pass-pass1'] == "OK" && $_SESSION['change-pass-pass2'] == "OK")
{
	$old_pass = hash('sha512', $_POST['old_pass']);
	$pass1 = hash('sha512', htmlentities($_POST['pass1']));
	$pass2 = hash('sha512', htmlentities($_POST['pass2']));

	check_regex_password($pass1, "flag-regex-password");
	check_old_pass($old_pass, "flag-old-pass");
	check_same_password($pass1, $pass2, "same-password");
}

if ($_SESSION['change-pass-old_pass'] == "OK" && $_SESSION['change-pass-pass1'] == "OK" &&
$_SESSION['change-pass-pass2'] == "OK" && $_SESSION['flag-regex-password'] == "OK" &&
$_SESSION['same-password'] == "OK" && $_SESSION['flag-old-pass'] == "OK")
{
	$_SESSION['flag-password-changed'] = "OK";
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("UPDATE `utilisateurs` SET `mdp` = :password WHERE `mail` LIKE :mail");
		$requete->bindParam(':mail', $_SESSION['mail']);
		$requete->bindParam(':password', $pass1);
		$requete->execute();

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

echo "<meta http-equiv='refresh' content='0,url=change-password.php'>";
?>
