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
<title>Gérer les utilisateurs - Camagru</title>
</head>

<body>
	<?php
	$current_page = "connexion";
	include '../../header.php';
	include '../../functions/admin-users.php'
	?>
	<div class="center">
		<h2>Liste des utilisateurs</h2><br/>
		<?php
		$data = get_list_users();
		if (count($data) == 1)
		{
			echo "<p class='text' style='text-align:center;'>Désolé, mais personne n'utilise ton site !</p>";
		}
		else {
			echo "<table cellspacing='0'>";
			foreach ($data as $user)
			{
				echo "<tr>";
				echo "<td>";
				echo $user['login'];
				echo "</td>";
				echo "<td>";
				echo $user['mail'];
				echo "</td>";
				echo "<td>";

				if ($user['login'] != 'admin')
				{
				echo "<a href='suppress-user.php?id=".$user['id']."'>Supprimer</a>";
				}
				echo "</td>";

				echo "</tr>";
			}
			echo "</table>";
		}
		?>


		<br/>
	</div>
</body>
<?php
include '../../footer.php';
?>
</html>
