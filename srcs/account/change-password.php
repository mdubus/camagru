<?php
session_start();
if ($_SESSION['login'] == NULL || !($_SESSION['login']))
{
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/inscription.css">
<meta name="google" content="notranslate" />
<title>Modifier mon mot de passe - Camagru</title>
</head>

<body>
	<?php
	include '../../header.php';
	include '../../errors.php';
	?>
	<div class="center">


		<form method="post" action="check-change-password.php">
			<fieldset>
				<legend>Modifier mon mot de passe</legend><br/>
				<label for="old_pass">Mon ancien mot de passe :</label>
				<input
				type="password"
				name="old_pass" id="old_pass"
				<?PHP
				if ($_SESSION['change-pass-old_pass'] == "KO" || $_SESSION['flag-old-pass'] == "KO")
				{echo "class='invalid'";}
				?>
				><br/><br/>
				<label for="pass1">Nouveau mot de passe :</label>
				<input
				type="password"
				name="pass1" id="pass1"
				<?PHP
				if ($_SESSION['change-pass-pass1'] == "KO" || $_SESSION['flag-regex-password'] == "KO")
				{echo "class='invalid'";}
				?>
				><br/><br/>
				<label for="pass2">Recopier le nouveau mot de passe :</label>
				<input
				type="password"
				name="pass2"
				id="pass2"
				<?PHP
				if ($_SESSION['change-pass-pass2'] == "KO" || $_SESSION['same-password'] == "KO")
				{echo "class='invalid'";}
				?>
				><br/><br/>
				<input
				type="submit"
				name="submit"
				value="Envoyer"/>
		</fieldset><br/>

		<?php
		error_change_password();
		if ($_SESSION['flag-password-changed'] == "OK")
			echo "<meta http-equiv='refresh' content='5,url=my-account.php'>";
		delete_error_change_password();
		 ?>


	</div>
</body>
</html>
