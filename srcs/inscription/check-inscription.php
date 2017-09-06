<?PHP session_start();

if (isset($_POST['identifiant']) && $_POST['identifiant'] != NULL
&& isset($_POST['mail']) && $_POST['mail'] != NULL
&& isset($_POST['password1']) && $_POST['password1'] != NULL
&& isset($_POST['password2']) && $_POST['password2'] != NULL)
{
	include "../../functions/inscription.php";
	$identifiant = htmlentities($_POST['identifiant']);
	$mail = htmlentities($_POST['mail']);
	$password1 = htmlentities($_POST['password1']);
	$password2 = htmlentities($_POST['password2']);

	check_form("inscription", "identifiant", $identifiant);
	check_form("inscription", "mail", $mail);
	check_form("inscription", "password1", $password1);
	check_form("inscription", "password2", $password2);
	check_exists_username($identifiant);
	check_regex_mail($mail);
	$return = check_exists_mail($mail);
	$_SESSION['flag-mail-exists'] = ($return > 0) ? "KO" : "OK";

	check_regex_password($password1, "flag-regex-password");
	check_same_password($password1, $password2, "same-password");
}

if ($_SESSION['inscription-identifiant'] == "OK" && $_SESSION['inscription-mail'] == "OK"
&& $_SESSION['inscription-password1'] == "OK" && $_SESSION['inscription-password2'] == "OK"
&& $_SESSION['flag-regex-password'] == "OK" && $_SESSION['flag-regex-mail'] == "OK"
&& $_SESSION['flag-user-exists'] == "OK" && $_SESSION['flag-mail-exists'] == "OK"
&& $_SESSION['same-password'] == "OK")
{
	$_SESSION['flag-inscription'] = "OK";
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$password = hash('sha512', $password1);
		$requete = $bdd->prepare("INSERT INTO `utilisateurs` (`login`, `mail`, `groupe`, `mdp`)
		VALUES(:identifiant, :mail, :user, :password)");
		$requete->bindParam(':identifiant', $identifiant);
		$requete->bindParam(':mail', $mail);
		$requete->bindValue(':user', 'user');
		$requete->bindParam(':password', $password);
		$requete->execute();

		// send_confirmation_mail($identifiant, $mail, $_POST['submit']);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	echo "<meta http-equiv='refresh' content='0,url=inscription.php'>";

}
else {
	echo "<meta http-equiv='refresh' content='0,url=inscription.php'>";
	exit();
}
?>
