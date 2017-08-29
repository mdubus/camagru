<?php
session_start();
$upload_dir = "../img/galerie/";
if (isset($_POST['hidden_data']) && $_POST['hidden_data'] != NULL)
{
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$filename = mktime() . $_SESSION['id'] . ".png";
$file = $upload_dir . $filename;
$path = "http://localhost:8080/camagru/" . $file;
$path_for_bdd = "http://localhost:8080/camagru/img/galerie/" . $filename;
$success = file_put_contents($file, $data);
$id = $_SESSION['id'];
try{
	$date_upload = time();
	include '../config/database.php';
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->query("USE camagru");
	$requete = $bdd->prepare("INSERT INTO `photos` (`link`, `id_user`, `date_upload`)
	VALUES(:link, :id_user, :date_upload)");
	$requete->bindParam(':link', $path_for_bdd);
	$requete->bindParam(':id_user', $id);
	$requete->bindParam(':date_upload', $date_upload);
	$requete->execute();
}
catch (PDOException $e) {
	print "Erreur : ".$e->getMessage()."<br/>";
	die();
}
}
else {
	echo "<meta http-equiv='refresh' content='0,url=../index.php'>";
}

?>
