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
<title>Inscription - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "inscription";
	include '../header.php';
	?>
	<div id="center">
		<h2>Inscription</h2><br/>

		<p class="text">Cupcake ipsum dolor sit amet marzipan halvah pastry. Sesame snaps toffee sweet roll dragée carrot cake. Pastry sweet marzipan fruitcake cupcake danish gingerbread sweet jelly-o.</p>
		<p class="text">Cake croissant muffin cupcake jelly beans liquorice carrot cake chocolate gingerbread. Macaroon sweet roll gummi bears. Pudding lemon drops tootsie roll caramels chocolate cake caramels.</p><br/>

		<form method="post" action="check-inscription.php">
			<p>Identifiant : </p>
			<input
			type="text"
			name="identifiant"
			<?PHP if ($_SESSION['inscription-identifiant'] == "KO" ||
			$_SESSION['flag-user-exists'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<p>Mail : </p>
			<input
			type="text"
			name="mail"
			<?PHP if ($_SESSION['inscription-mail'] == "KO" ||
			$_SESSION['flag-regex-mail'] == "KO" || $_SESSION['flag-mail-exists'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<p>Mot de passe : </p>
			<input
			type="password"
			name="password1"
			<?PHP if ($_SESSION['inscription-password1'] == "KO" ||
			$_SESSION['flag-regex-password'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<p>Répéter le mot de passe : </p>
			<input
			type="password"
			name="password2"
			<?PHP if ($_SESSION['inscription-password2'] == "KO")
			{echo "class='invalid'";}?>><br/><br/>
			<input
			type="submit"
			name="submit"
			value="Envoyer"/>
		</form><br/><br/>

		<?PHP
		include "../errors.php";
		error_inscription();
		delete_error_inscription();
		?>
	</div>
</body>



</html>
