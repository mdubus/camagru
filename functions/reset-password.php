<?php

	function	check_token_reset_password($password1, $token, $mail)
	{
		try{
			include '../../config/database.php';
			$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$bdd->query("USE camagru");
			$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `mail`= :mail");
			$requete->bindParam(':mail', $mail);
			$requete->execute();
			$code = $requete->fetch(PDO::FETCH_ASSOC);
			if (in_array($token, $code) == TRUE)
			$_SESSION['reset-good-token'] = "OK";
			else {
				$_SESSION['reset-good-token'] = "KO";
			}
		}
		catch (PDOException $e) {
			print "Erreur : ".$e->getMessage()."<br/>";
			die();
		}
	}

 ?>
