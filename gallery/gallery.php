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
<link rel="stylesheet" type="text/css" href="../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Galerie - Camagru</title>
</head>

<body>
	<?php
  	$current_page = "gallery";
	include '../header.php';
	include '../functions.php';
	?>
	<div id="center">
		<h2>Galerie</h2><br/>

	<div id="gallery">
<?php
	$data = get_gallery_data();

	foreach ($data as $key=>$elem)
	{
		echo "<div class='photo'>";
		echo "<a href='#'><img src='".$elem['link']."'></a>";
		echo "</div>";

	}

 ?>
	</div>



	</div>
</body>
</html>
