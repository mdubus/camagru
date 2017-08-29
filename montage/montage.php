<?PHP session_start();
if (!$_SESSION['login'])
{
	echo "<meta http-equiv='refresh' content='0,url=../index.php'>";
}
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
<link rel="stylesheet" type="text/css" href="../css/montage.css">
<link rel="stylesheet" type="text/css" href="../css/gallery.css">
<meta name="google" content="notranslate" />
<title>Montage - Camagru</title>
</head>

<body>
	<?php
	$current_page = "montages";
	include '../header.php';
	?>
	<div class="center">
		<h2>Montages</h2><br/>

		<p class="text">Cupcake ipsum dolor sit amet marzipan halvah pastry. Sesame snaps toffee sweet roll dragée carrot cake. Pastry sweet marzipan fruitcake cupcake danish gingerbread sweet jelly-o.</p>
		<p class="text">Cake croissant muffin cupcake jelly beans liquorice carrot cake chocolate gingerbread. Macaroon sweet roll gummi bears. Pudding lemon drops tootsie roll caramels chocolate cake caramels.</p><br/>
		<p class="text" style="text-align:center;"><a href="montages-users.php<?PHP echo '?login='.$_SESSION['login']; ?>"> Voir tous mes montages</a></p><br/><br/>
		<div id="camera">

			<video id="video" width="400px" height="300px" autoplay></video>
			<canvas id="canvas" width="400px" height="300px"></canvas><br/><br/>
			<div id="buttons">
				<button id="reset">Reset</button>
				<button id="upload">Uploader une image</button>
				<button id="snap">Prendre la photo</button>
				<button id="save">Sauvegarder</button>
				<form method="post" accept-charset="utf-8" name="form1">
					<input name="hidden_data" id='hidden_data' type="hidden"/>
				</form>
			</div>
		</div><br/><br/>
		<div class="gallery" id="photos"></div>
		<script src="camera_handle.js"></script>

	</div>
</body>



</html>
