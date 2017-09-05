<?php
session_start();
 ?>

<header>
  <h1><a href="/camagru/index.php">Camagru</a></h1>
</header>
<nav>

	<a  <?PHP if ($current_page == "gallery"){echo "id='current'";}?>href='/camagru/srcs/gallery/gallery.php?page=1'><div>Galerie</div></a>
	<?PHP
	echo "<a ";
	if ($current_page == "montages"){
		echo "id='current'";
	}
	echo "href='/camagru/srcs/montage/montage.php'><div>Montages</div></a>";
	if ($_SESSION['connected'] == "OK")
	{
		echo "<a ";
		if ($current_page == "my-account"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/account/my-account.php'><div>Mon compte</div></a>";
		if ($_SESSION['groupe'] == 'admin')
		{
		echo "<a ";
		if ($current_page == "admin"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/admin/admin.php'><div>Administration</div></a>";
	}
		echo "<a ";
		if ($current_page == "deconnexion"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/account/deconnexion.php'><div>Déconnexion</div></a>";
	}
	else
	{
		echo "<a ";
		if ($current_page == "inscription"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/inscription/inscription.php'><div>Inscription</div></a>";
		echo "<a ";
		if ($current_page == "connexion"){
			echo "id='current'";
		}
		echo "href='/camagru/srcs/connexion/connexion.php'><div>Connexion</div></a>";
	}
	?>
</nav>
