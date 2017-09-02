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
<div id="camera-and-filters">
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
	</div>

	<div id="side">
		<img src="../../img/fleche-haut.png" id='fleche-haut' onclick='to_top()'/>

		<div id="filters">
			<?php
			include '../../functions/filters.php';

			$data = get_filters();
			foreach ($data as $filter)
			{
				echo "<img src='../../".$filter['path_filter']."' class='hidden_path'/>";
			}
			for ($i = 0; $i < 5; $i++)
			{
				echo "<div class='filter' style='display:block;'>";
				echo "<img src='' class='image_filter'/>";
				echo "</div>";
			}

			?>


		</div>
		<img src="../../img/fleche-bas.png" id='fleche-bas' onclick='to_bot()'/>

	</div>
	<script>

var img = document.getElementsByClassName('hidden_path');
var filter = document.getElementsByClassName('image_filter');
for (i = 0; i < 5; i++)
{
	filter[i].src = img[i].src;
}
var j = 0;
function	to_bot()
{
	j++;
	if (j >= img.length)
	{
		j = 0;
	}
	var k = j;
	var l = 0;
	while (l < 5)
	{
		if (k >= img.length)
		{
			k = 0;
		}
		filter[l].src = img[k].src;
		l++;
		k++;

	}
}

function	to_top()
{
	j--;
	if (j <= -(img.length + 1))
	{
		j = -1;
	}

	var k = j;
	var l = 0;
	while (l < 5)
	{
		if (k <= 0)
		{
			k = img.length + j;
		}
		if (k >= img.length)
		{
			k = 0;
		}
		filter[l].src = img[k].src;
		l++;
		k++;

	}
}

	</script>
</div>


<br/><br/>
<script src="camera_handle.js"></script>


<p class='text'>Tu préfères uploader une image ?</p>
<form method="post" action="reception.php" enctype="multipart/form-data">
	<p class='text'>Fichier (Format jpg, jpeg et png, 2 Mo max) :</p><br />
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
