<?PHP session_start();
if ($_SESSION['login'] == NULL)
	echo "<meta http-equiv='refresh' content='0,url=../index.php'>";
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../css/global.css">
<link rel="stylesheet" type="text/css" href="../css/header.css">
<meta name="google" content="notranslate" />
<title>Mon compte - Camagru</title>
</head>

<body>
	<?php
	$current_page = "my-account";
	include '../header.php';
	?>
	<div id="center">
		<h2>Bienvenue <?PHP echo $_SESSION['login'];?></h2>
		<br/><br/>
		<h3>Statistiques</h3>
		<p class="text"> Nombre de like sur mes photos : </p>
		<p class="text"> Ma photo la plus likée : </p><br/>
		<p class="text"> Nombre de commentaires sur mes photos : </p>
		<p class="text"> Ma photo la plus commentée : </p><br/>


		<p class="text"><a href="suppress-account.php">Je souhaite supprimer mon compte</a></p>

		<?PHP
		if ($_SESSION['wish-to-suppress-account'] == "OK")
		{
			echo "<p class='text'>Souhaites-tu vraiment supprimer ton compte ?</p>";
			echo "<form method='post' action='suppress-account.php'>";
			echo "<input type='submit' name='oui' value='Oui'/>\t";
			echo "<input type='submit' name='non' value='Non'/><br/><br/>";
			echo "</form><br/><br/>";

		}
		if ($_SESSION['session-destroy'] == "OK")
		{
			echo "<div id='inscription-ko'><p>Ton compte a bien été supprimé.</p>";
			echo "<p>Tu vas être redirigé vers l'accueil dans 5 secondes.</p></div>";
			session_destroy();
			echo "<meta http-equiv='refresh' content='5,url=../index.php'>";
		}
		?>



	</div>
</body>
</html>
