<header>
  <h1><a href="http://localhost:8080/camagru/index.php">Camagru</a></h1>
</header>
<nav>
  <ul>
    <li><a <?PHP if ($current_page == "accueil"){echo "id='current'";}?> href="http://localhost:8080/camagru/index.php">Accueil</a></li>
	<li><a  <?PHP if ($current_page == "gallery"){echo "id='current'";}?>href='http://localhost:8080/camagru/gallery/gallery.php'>Galerie</a></li>
	<?PHP
	if ($_SESSION['connected'] == "OK")
	{
		echo "<li><a href='#'>Montages</a></li>";
	}
	if ($_SESSION['connected'] != "OK")
	{
		echo "<li><a ";
		if ($current_page == "inscription"){
			echo "id='current'";
		}
		echo "href='http://localhost:8080/camagru/inscription/inscription.php'>Inscription</a></li>";
		echo "<li><a ";
		if ($current_page == "connexion"){
			echo "id='current'";
		}
		echo "href='http://localhost:8080/camagru/connexion/connexion.php'>Connexion</a></li>";
	}
	else {
		echo "<li><a ";
		if ($current_page == "my-account"){
			echo "id='current'";
		}
		echo "href='http://localhost:8080/camagru/account/my-account.php'>Mon compte</a></li>";
		echo "<li><a ";
		if ($current_page == "deconnexion"){
			echo "id='current'";
		}
		echo "href='http://localhost:8080/camagru/account/deconnexion.php'>Déconnexion</a></li>";
	}
	?>
  </ul>
</nav>
