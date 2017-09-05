<?PHP
session_start();
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
<title>Deconnexion - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "deconnexion";
	include '../../header.php';
	?>
	<div class="center">
		<h2>À bientôt <?PHP echo $_SESSION['login'];?> !</h2><br/>

		<p class="text" style="text-align:center;">Tu as bien été déconnecté et vas être redirigé vers l'accueil dans 5 secondes.</p><br/>
	</div>
</body>
</html>

<?PHP
session_destroy();

	echo "<meta http-equiv='refresh' content='5,url=../../index.php'>";
	include '../../footer.php';
?>
