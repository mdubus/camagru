<?PHP session_start();
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
<link rel="stylesheet" type="text/css" href="../../css/montage.css">
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Montage - Camagru</title>
</head>

<body>
	<?php
	$current_page = "montages";
	include '../../header.php';
	echo '<div class="center">';
	if (!$_SESSION['login'])
	{
		echo "<p class='text' style='text-align:center;'>Cette page est réservée aux membres.</p>";
		echo "<p class='text' style='text-align:center;'>Pour t'inscrire c'est <a href='../inscription/inscription.php'>par ici</a></p>";
	}
	else {

		include 'go-to-montage.php';

	}
	?>
</body>



</html>
