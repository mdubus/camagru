<?PHP session_start();

include "../functions.php";

$mail = htmlentities($_POST['mail']);
$password = htmlentities($_POST['password']);

check_form('connexion', 'mail', $mail);
check_form('connexion', 'password', $password);
if ($_SESSION['connexion-mail'] == "OK" && $_SESSION['connexion-password'] == "OK")
{
  	$return = check_exists_mail($mail);
	if ($return > 0)
	{
		$_SESSION['connexion-mail-exists'] = "OK";
		$infos = connexion_check_password($mail, hash(sha512, $password));
		$_SESSION['id'] = $infos['id'];
		$_SESSION['login'] = $infos['login'];
		$_SESSION['mail'] = $infos['mail'];
		$_SESSION['groupe'] = $infos['groupe'];
		$_SESSION['connected'] = "OK";
		echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
	}
	else
	{
		$_SESSION['connexion-mail-exists'] = "KO";
		echo "<meta http-equiv='refresh' content='0,url=connexion.php'>";
	}
}
else
	echo "<meta http-equiv='refresh' content='0,url=connexion.php'>";
?>
