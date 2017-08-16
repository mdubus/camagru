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
<title>Connexion - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "connexion";
	include '../header.php';
	?>
	<div id="center">
		<h2>Connexion</h2><br/>

		<p class="text">Cupcake ipsum dolor sit amet marzipan halvah pastry. Sesame snaps toffee sweet roll dragée carrot cake. Pastry sweet marzipan fruitcake cupcake danish gingerbread sweet jelly-o.</p><br/>

		<form method="post" action="check-connexion.php">
			<p>Mail : </p>
			<input type="text" name="mail"
			<?PHP if ($_SESSION['connexion-mail'] == "KO" ||
			$_SESSION['connexion-mail-exists'] == "KO")
			{echo "class='invalid'";}?>
			><br/><br/>
			<p>Mot de passe : </p>
			<input type="password" name="password"
			<?PHP if ($_SESSION['connexion-password'] == "KO" ||
			$_SESSION['connexion-good-password'] == "KO")
			{echo "class='invalid'";}?>
			><br/><br/>
			<input
			type="submit"
			name="submit"
			value="Envoyer"/><br/><br/>
			<p class="text">Tu as oublié ton mot de passe ? <a href="http://localhost:8080/camagru/reset-password/reset-password.php">Clique ici !</a></p>
		</form><br/><br/>
		<?PHP
		include "../errors.php";
		error_connexion();
		delete_error_connexion();
		?>



	</div>
</body>
</html>
