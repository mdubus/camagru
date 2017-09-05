<?PHP session_start();?>
<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');
</style>
<link rel="stylesheet" type="text/css" href="../../css/global.css">
<link rel="stylesheet" type="text/css" href="../../css/header.css">
<link rel="stylesheet" type="text/css" href="../../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Galerie - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "gallery";
	include '../../header.php';
	include '../../functions/gallery.php';
	?>
	<div id="center">
		<h2>Galerie</h2><br/>


<?php
$nb_montages = get_nb_montages();
$_SESSION['max_page'] = ceil($nb_montages / 10);

if (isset($_GET['page']) && $_GET['page'] != NULL && is_numeric($_GET['page'])
&& $_GET['page'] > 0 && $_GET['page'] <= $_SESSION['max_page'])
{
	$_SESSION['page'] = $_GET['page'];
	$data = get_gallery_data($_SESSION['page']);
	echo "<div class='gallery' id='common-gallery'>";
	foreach ($data as $key=>$elem)
	{
		echo "<div class='photo'>";
		echo "<a href='../photo/photo.php?id_photo=".$elem['id_photo']."'><img src='../../".$elem['link']."'></a>";
		echo "</div>";

	}
	echo "</div>";
	echo "<div id='pagination'>";

	if ($nb_montages > 10)
	{


		if ($_SESSION['page'] == 1)
		{
			echo "<img src='../../img/fleche-haut-nope.png'/>";
		}
		else {
			echo "<a class='link' href='gallery.php?page=1'>1</a>";

			echo "<img src='../../img/fleche-haut.png' onclick='previous_page()'/>";
		}
		echo "<p class='text' id='current_page'>page ".$_SESSION['page']."</p>";
		if ($_SESSION['page'] < $_SESSION['max_page'])
		{
			echo "<img src='../../img/fleche-bas.png' onclick='next_page()'/>";
			echo "<a  class='link' href='gallery.php?page=".$_SESSION['max_page']."'>".$_SESSION['max_page']."</a>";
		}
		else {
			echo "<img src='../../img/fleche-bas-nope.png'/>";
		}
	}
	echo "</div>";
}
else {
	echo "<meta http-equiv='refresh' content='0,url=gallery.php?page=1'>";
}
 ?>

	<script src="pages.js"></script>


	</div>
</body>
<?php
include '../../footer.php';
 ?>
</html>
