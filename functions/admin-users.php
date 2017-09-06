<?PHP

function	get_list_users()
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT `id`, `login`, `mail` FROM `utilisateurs`");
		$requete->execute();
		$code = $requete->fetchAll(PDO::FETCH_ASSOC);
		return ($code);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	suppress_user($id)
{
	try{
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");

		$requete = $bdd->prepare("DELETE FROM `comments` WHERE `id_user`= :id_user");
		$requete->bindParam(':id_user', $id);
		$requete->execute();

		$requete = $bdd->prepare("DELETE FROM `likes` WHERE `id_user`= :id_user");
		$requete->bindParam(':id_user', $id);
		$requete->execute();

		$requete = $bdd->prepare("DELETE FROM `photos` WHERE `id_user`= :id_user");
		$requete->bindParam(':id_user', $id);
		$requete->execute();

		$requete = $bdd->prepare("DELETE FROM `utilisateurs` WHERE `id`= :id");
		$requete->bindParam(':id', $id);
		$requete->execute();
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_id_exists($id)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `id` LIKE :id");
		$requete->bindParam(':id', $id);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

function	check_if_not_admin($id)
{
	try{
		$name = "img/filtres/".$filter.".png";
		include '../../config/database.php';
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("USE camagru");
		$requete = $bdd->prepare("SELECT * FROM `utilisateurs` WHERE `login` LIKE 'admin' AND `id` LIKE :id");
		$requete->bindParam(':id', $id);
		$requete->execute();
		$result = $requete->rowCount();
		return ($result);

	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
}

?>
