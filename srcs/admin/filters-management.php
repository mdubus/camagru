<?PHP session_start();
if ($_SESSION['groupe'] != 'admin')
{
	echo "<meta http-equiv='refresh' content='0,url=../account/my-account.php'>";
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/admin.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<meta name="google" content="notranslate" />
<title>Gérer les filtres - Camagru</title>
</head>

<body>
	<?php
	$current_page = "admin";
	include '../../header.php';
	include '../../functions/admin-filters.php'
	?>
	<div class="center">
		<h2>Liste des filtres</h2><br/>
		<?php
		$data = get_list_filters();
		echo "<table cellspacing='0'>";
		foreach ($data as $filter)
		{
			echo "<tr>";
			echo "<td>";
			echo str_replace("img/filtres/", "", str_replace(".png", "", $filter['path_filter']));
			echo "</td>";
			echo "<td>";

			if ($filter['login'] != 'admin')
			{
				echo "<a href='suppress-filter.php?id=".$filter['id_filter']."'>Supprimer</a>";
			}
			echo "</td>";

			echo "</tr>";
		}
		echo "</table>";

		if ($_SESSION['error-delete-filter'] == "KO")
		{
			echo "<br/><div id='inscription-ko'>Erreur : Vous devez laisser au moins 5 filtres !</div>";
			$_SESSION['error-delete-filter'] = NULL;
		}


		?>


		<br/>

		<h2>Ajouter un filtre</h2><br/>
		<p class='text' style='text'>Ton filtre doit être en PNG, et se trouver dans le même répertoire que les autres (img/filtres).</p>
		<form method="POST" action="add-filter.php">
			<p class='text'>Le nom de ton filtre, sans l'extension : </p>
			<input type="text" name="filter" id="filter">
			<input type="submit" name="submit" value="Envoyer"/>

		</form>

	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
