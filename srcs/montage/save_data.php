<?php
session_start();

function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
	$cut = imagecreatetruecolor($src_w, $src_h);
	imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
	imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
}

if (isset($_POST['hidden_data']) && $_POST['hidden_data'] != NULL && isset($_POST['hidden_data2']) && $_POST['hidden_data2'] != NULL)
{
	$upload_dir = "../../img/galerie/";
	$img = $_POST['hidden_data'];
	$img2 = $_POST['hidden_data2'];

	$img = str_replace('data:image/png;base64,', '', $img);
	$img2 = str_replace('data:image/png;base64,', '', $img2);

	$img = str_replace(' ', '+', $img);
	$img2 = str_replace(' ', '+', $img2);

	$img = base64_decode($img);
	$img2 = base64_decode($img2);

	$_SESSION['image1'] = $img;
	$_SESSION['image2'] = $img2;


	$filename = mktime() . $_SESSION['id'] . ".png";

	$img = imagecreatefromstring($img);
	$img2 = imagecreatefromstring($img2);

	imagecopymerge_alpha($img, $img2, 0, 0, 0, 0, 400, 300, 100);
	imagepng($img, "../../img/galerie/".$filename);


	$file = $upload_dir . $filename;
	$path = $file;
	$path_for_bdd = "img/galerie/" . $filename;
	$id = $_SESSION['id'];
	try{
		$date_upload = time();
		include '../../config/database.php';
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
	echo "<meta http-equiv='refresh' content='0,url=../../index.php'>";
	exit();
}

?>
