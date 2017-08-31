<?php
session_start();
 ?>

<header>
  <h1><a href="/camagru/index.php">Camagru</a></h1>
</header>
<nav>
  <ul>

	<li><a  <?PHP if ($current_page == "gallery"){echo "id='current'";}?>href='/camagru/srcs/gallery/gallery.php'>Galerie</a></li>
	<?PHP
	echo "<li><a ";
	if ($current_page == "montages"){
		echo "id='current'";
	}
	echo "href='/camagru/srcs/montage/montage.php'>Montages</a></li>";
	if ($_SESSION['connected'] == "OK")
	{
		echo "<li><a ";
		if ($current_page == "my-account"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/account/my-account.php'>Mon compte</a></li>";
		echo "<li><a ";
		if ($current_page == "montages-users"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/montage/montages-users.php?login=" . $_SESSION['login'] . "'>Mes montages</a></li>";
		echo "<li><a ";
		if ($current_page == "deconnexion"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/account/deconnexion.php'>Déconnexion</a></li>";
	}
	else
	{
		echo "<li><a ";
		if ($current_page == "inscription"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/inscription/inscription.php'>Inscription</a></li>";
		echo "<li><a ";
		if ($current_page == "connexion"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/connexion/connexion.php'>Connexion</a></li>";
	}
	?>
  </ul>
</nav>
