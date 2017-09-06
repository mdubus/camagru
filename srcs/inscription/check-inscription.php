<?PHP session_start();

	include "../../functions/inscription.php";
	check_form("inscription", "identifiant", $_POST['identifiant']);
	check_form("inscription", "mail", $_POST['mail']);
	check_form("inscription", "password1", $_POST['password1']);
	check_form("inscription", "password2", $_POST['password2']);

	if ($_SESSION['inscription-identifiant'] == "OK")
	{
		$identifiant = htmlentities($_POST['identifiant']);
		check_exists_username($identifiant);

	}

	if ($_SESSION['inscription-mail'] == "OK")
	{
		$mail = htmlentities($_POST['mail']);
		check_regex_mail($mail);
		$return = check_exists_mail($mail);
		$_SESSION['flag-mail-exists'] = ($return > 0) ? "KO" : "OK";
	}

	if ($_SESSION['inscription-password1'] == "OK")
	{
		$password1 = $_POST['password1'];
		check_regex_password($password1, "flag-regex-password");
	}

	if ($_SESSION['inscription-password2'] == "OK")
	{
		$password2 = $_POST['password2'];
	}
	if ($_SESSION['inscription-password1'] == "OK" && $_SESSION['inscription-password2'] == "OK")
	{
		check_same_password($password1, $password2, "same-password");
	}

if ($_SESSION['inscription-identifiant'] == "OK" && $_SESSION['inscription-mail'] == "OK"
&& $_SESSION['inscription-password1'] == "OK" && $_SESSION['inscription-password2'] == "OK"
&& $_SESSION['flag-regex-password'] == "OK" && $_SESSION['flag-regex-mail'] == "OK"
&& $_SESSION['flag-user-exists'] == "OK" && $_SESSION['flag-mail-exists'] == "OK"
&& $_SESSION['same-password'] == "OK")
{
	echo $identifiant;

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

		send_confirmation_mail($identifiant, $mail, $_POST['submit']);
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
