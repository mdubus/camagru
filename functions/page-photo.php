<?php

	function	get_infos_user_photo($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT `link`, `login`, `mail` FROM `photos` INNER JOIN `utilisateurs` ON utilisateurs.id = photos.id_user WHERE `id_photo` LIKE :id_photo");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->execute();
			$data = $requete->fetchAll(PDO::FETCH_ASSOC);
			return ($data);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	get_nb_likes($id_photo)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `likes` WHERE `id_photo`= :id_photo");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_already_liked($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `likes` INNER JOIN `utilisateurs` ON utilisateurs.id = likes.id_user WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->bindParam(':id_user', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	check_if_my_photo($id_photo, $id)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo`= :id_photo AND `id_user` = :id_user");
			$requete->bindParam(':id_photo', $id_photo);
			$requete->bindParam(':id_user', $id);
			$requete->execute();
			$result = $requete->rowCount();
			return ($result);
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

	function	can_i_like_it($id_photo)
	{
		if (isset($_SESSION['login']))
		{
			$_SESSION['already_liked'] = check_if_already_liked($id_photo, $_SESSION['id']);
			$_SESSION['my_photo'] = check_if_my_photo($_GET['id_photo'], $_SESSION['id']);
			if ($_SESSION['already_liked'] != 0 || $_SESSION['my_photo'] != 0)
			{
				echo 'src="../../img/paw-grey.png"';
				if ($_SESSION['already_liked'] != 0)
				echo 'title="Tu aimes déjà cette image !"';
				else if ($_SESSION['my_photo'] != 0)
				echo 'title="Tu ne peux pas aimer ta propre image !"';
			}
			else {
				echo 'src="../../img/paw-black.png"';
				echo 'onmouseover="this.src=\'../../img/paw-pink.png\'"';
				echo 'onmouseout="this.src=\'../../img/paw-black.png\'"';
				echo 'onclick="increment_like(this)"';
				$_SESSION['click-like'] = "OK";
				$_SESSION['id_photo'] = $id_photo;
			}
		}
		else {
			echo 'src="../../img/paw-grey.png"';
			echo 'title="Vous devez être connecté pour aimer cette image !"';
		}
	}


function	get_comments($id_photo)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$bdd->query("SET NAMES UTF8");
		$requete = $bdd->prepare("SELECT `login`, `comments`, `id_comment` FROM `comments` INNER JOIN `utilisateurs` ON utilisateurs.id = comments.id_user WHERE `id_photo` LIKE :id_photo");
		$requete->bindParam(':id_photo', $id_photo);
		$requete->execute();
		$data = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	get_mail_user($login)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$bdd->query("SET NAMES UTF8");
		$requete = $bdd->prepare("SELECT `mail` FROM `utilisateurs` WHERE `login` LIKE :login");
		$requete->bindParam(':login', $login);
		$requete->execute();
		$data = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($data);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	send_comment_mail($identifiant, $id_photo, $submit, $mail)
{
		$name = "Camagru";
		$message = "<br/>Cher " . $identifiant . ",<br/><br/>" .
		"Un de tes montages vient d'être commenté". "<br/>".
		"Pour le consulter, rends-toi <a href='http://localhost:8080/camagru/srcs/photo/photo.php?id_photo=".$id_photo."'>à l'adresse suivante</a>" . "<br/><br/>" .
		"À bientôt !";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
     	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: Camagru';
		$to = $mail;
		$subject = 'Nouveau commentaire sur un montage';
		$body = "From: $name<br/>To: $to<br/>Message:<br/>$message";

		if ($submit)
		{
			if (mail ($to, $subject, $body, $headers) == FALSE)
			{
				die("error");
			}
		}
}


function	put_comments($comments)
{
if ($comments == NULL)
{
	echo "<br/><p class='text' style='text-align:center;'>Il n'y a encore aucun commentaire sur cette photo. Sois le premier !</p>";
}
else {
	echo "<br/>";
	foreach ($comments as $data)
	{
		// print_r ($data);

		if ($data['login'] == $_SESSION['login'])
		{
			echo "<div id='comment' onmouseover=\"getElementById('".$data['id_comment'];
			echo "').style.display='block'\" onmouseout=\"getElementById('".$data['id_comment'];
			echo "').style.display='none'\" >";
			echo "<p class='text'>Posté par <a href='../montage/montages-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
			echo "<a href='delete-comment.php?id-comment=".$data['id_comment']."' class='delete-comment' id='".$data['id_comment']."'>Supprimer</a>";
		}
		else {
			echo "<div id='comment'>";
			echo "<p class='text'>Posté par <a href='../montage/montages-users.php?login=".$data['login']."'>".$data['login']."</a></p>";
			echo "<p class='text'>".$data['comments']."</p>";
		}
		echo "</div>";
		echo "<br/>";
	}
}
}

function	check_if_picture_exists($id)
{
	if (isset($id) && $id != NULL && is_numeric($id))
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo");
			$requete->bindParam(':id_photo', $id);
			$requete->execute();
			$code = $requete->rowCount();
			if ($code == 0)
			{
				header('Location: ../gallery/gallery.php');
				exit();
			}
			else {
				$_SESSION['id_photo'] = $id;
			}
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}
	else {
		header('Location: ../gallery/gallery.php');
		exit();
	}
}

function	picture_belong_to_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `photos` WHERE `id_photo` = :id_photo AND `id_user` = :id_user");
		$requete->bindParam(':id_photo', $id);
		$requete->bindParam(':id_user', $_SESSION['id']);
		$requete->execute();
		$code = $requete->rowCount();
		return ($code);

}
catch (PDOException $e) {
	print "Erreur : ".$e->getMessage()."<br/>";
	die();
}
}


?>
