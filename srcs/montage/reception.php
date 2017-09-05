<?php
session_start();
if ($_FILES['image']['error'] > 0 || !(isset($_POST['submit'])) || !(isset($_FILES['image'])))
{
	$_SESSION['send-image-error'] = "KO";
	// UPLOAD_ERR_NO_FILE : fichier manquant.
	// UPLOAD_ERR_INI_SIZE : fichier dépassant la taille maximale autorisée par PHP.
	// UPLOAD_ERR_FORM_SIZE : fichier dépassant la taille maximale autorisée par le formulaire.
	// UPLOAD_ERR_PARTIAL : fichier transféré partiellement.
}

if ($_SESSION['send-image-error'] != "KO")
{
	if ($_FILES['image']['size'] > 2097152)
	{
		$_SESSION['send-image-size'] = "KO";
	}
}

if ($_SESSION['send-image-size'] != "KO")
{
	$extensions = array('png');
	$extension_upload = strtolower(substr(strchr($_FILES['image']['name'], '.'), 1));
	if (!(in_array($extension_upload, $extensions)))
	{
		$_SESSION['send-image-extension'] = "KO";
	}
}

if ($_SESSION['send-image-extension'] != "KO")
{
	$maxwidth = 800;
	$maxheight = 600;
	$image_sizes = getimagesize($_FILES['image']['tmp_name']);
	if ($image_sizes[0] > $maxwidth || $image_sizes[1] > $maxheight)
	{
		$_SESSION['send-image-dimensions'] = "KO";
	}
	$date_upload = mktime();

	$nom = '../../img/galerie/' . $date_upload . $_SESSION['id'] . '.'. $extension_upload;
	$result = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
	if ($result)
	{
		$_SESSION['print_file_uploaded'] = "<img src='".$nom."' style='display:none;' id='uploaded_file' />";
		
		// echo "Transfert réussi !<br/>";
		// try{
		// 	$_SESSION['link'] = '/img/galerie/'. $date_upload . $_SESSION['id'] . '.'. $extension_upload;
		// 	include '../../config/database.php';
		// 	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		// 	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// 	$bdd->query("USE camagru");
		// 	$requete = $bdd->prepare("INSERT INTO `photos` (`date_upload`, `link`, `id_user`)
		// 	VALUES(:date_upload, :link, :id_user)");
		// 	$requete->bindParam(':date_upload', $date_upload);
		// 	$requete->bindParam(':link', $_SESSION['link']);
		// 	$requete->bindValue(':id_user', $_SESSION['id']);
		// 	$requete->execute();
		// }
		// catch (PDOException $e) {
		// 	print "Erreur : ".$e->getMessage()."<br/>";
		// 	die();
		// }
	}

}

echo "<meta http-equiv='refresh' content='0,url=montage.php'>";


?>
