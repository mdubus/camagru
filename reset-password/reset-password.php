<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../css/global.css">
<link rel="stylesheet" type="text/css" href="../css/header.css">
<link rel="stylesheet" type="text/css" href="../css/inscription.css">
<meta name="google" content="notranslate" />
<title>Reinitialisation du mot de passe - Camagru</title>
</head>

<body>
	<?php
	include '../header.php';
	?>
	<div id="center">
		<h2>Réinitialiser mon mot de passe</h2><br/>

		<p class="text">Cupcake ipsum dolor sit amet marzipan halvah pastry. Sesame snaps toffee sweet roll dragée carrot cake. Pastry sweet marzipan fruitcake cupcake danish gingerbread sweet jelly-o.</p><br/>

		<form method="post" action="check-reset-password.php">
			<p>Mail : </p>
			<input type="text" name="mail"><br/><br/>
			<input
			type="submit"
			name="submit"
			value="Envoyer"/><br/><br/>
		</form><br/><br/>
		<?PHP
		include "../errors.php";
		error_reset_password();
		?>


	</div>
</body>
</html>
