<?php
session_start();

if (isset($_POST['comment']) && $_POST['comment'] != NULL)
{
	include '../../functions/page-photo.php';
	$comment = htmlentities($_POST['comment']);
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
		$requete->bindParam(':id_photo', $_SESSION['id_photo']);
		$requete->execute();
		$code = $requete->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	if ($code == NULL)
	{
		echo "<meta http-equiv='refresh' content='0,url=../gallery/gallery.php?page=1'>";
	}
	else {

		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("INSERT INTO `comments` (`id_user`, `id_photo`, `comments`)
			VALUES (:id_user, :id_photo, :comments);");
			$requete->bindParam(':id_photo', $_SESSION['id_photo']);
			$requete->bindParam(':id_user', $_SESSION['id']);
			$requete->bindParam(':comments', $comment);
			$requete->execute();

			$_SESSION['comment-send'] = "OK";
			$mail = get_mail_user($_SESSION['login-target']);
			if ($mail[0]['mail'] != $_SESSION['mail'])
			{
				send_comment_mail($_SESSION['login-target'], $_SESSION['id_photo'], $_POST['submit'], $mail[0]['mail']);
			}
			echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}
}
else {
	echo "<meta http-equiv='refresh' content='0,url=photo.php?id_photo=".$_SESSION['id_photo']."'>";
	$_SESSION['comment-send'] = "KO";
	exit();

}

?>
