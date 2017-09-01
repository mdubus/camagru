<h2>Montages</h2><br/>

<p class="text">Cupcake ipsum dolor sit amet marzipan halvah pastry. Sesame snaps toffee sweet roll dragée carrot cake. Pastry sweet marzipan fruitcake cupcake danish gingerbread sweet jelly-o.</p>
<p class="text">Cake croissant muffin cupcake jelly beans liquorice carrot cake chocolate gingerbread. Macaroon sweet roll gummi bears. Pudding lemon drops tootsie roll caramels chocolate cake caramels.</p><br/>
<?PHP	if ($_SESSION['nb_montages'] != 0)
	{
		echo '<p class="text" style="text-align:center;"><a href="montages-users.php';
		echo '?login='.$_SESSION['login'];
		echo '"> Voir tous mes montages</a></p><br/><br/>';
	}
?>
<div id="camera">
<video id="video" width="400px" height="300px" autoplay></video>
	<canvas id="canvas" width="400px" height="300px"></canvas><br/><br/>
	<div id="buttons">
		<button id="reset">Reset</button>

		<button id="snap">Prendre la photo</button>
		<button id="save">Sauvegarder</button>
		<form method="post" accept-charset="utf-8" name="form1">
			<input name="hidden_data" id="hidden_data" type="hidden"/>
		</form>

	</div>
</div><br/><br/>
<script src="camera_handle.js"></script>


<p class='text'>Tu préfères uploader une image ?</p>
<form method="post" action="reception.php" enctype="multipart/form-data">
<p class='text'>Fichier (Format jpg, jpeg et png, 1 Mo max) :</p><br />
<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
<input type="file" name="image" id="image" /><br />
<input type="submit" name="submit" value="Envoyer" />

<?php

if ($_SESSION['send-image-error'] == "KO")
{
	echo "<div id='inscription-ko'>Erreur lors du transfert du fichier</div>";
	$_SESSION['send-image-error'] = NULL;
}
if ($_SESSION['send-image-size'] == "KO")
{
	echo "<div id='inscription-ko'>Erreur : Ton fichier est trop volumineux</div>";
	$_SESSION['send-image-size'] = NULL;
}
if ($_SESSION['send-image-extension'] == "KO")
{
	echo "<div id='inscription-ko'>Erreur : L'extension est invalide</div>";
	$_SESSION['send-image-extension'] = NULL;
}
if ($_SESSION['send-image-dimensions'] == "KO")
{
	echo "<div id='inscription-ko'>Erreur : Dimensions invalides</div>";
	$_SESSION['send-image-dimensions'] = NULL;
}





 ?>



<br/><br/><div class="gallery" id="photos"></div>

</div>
