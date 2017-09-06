<?php
include 'database.php';
include 'functions-database-creation.php';
session_start();
session_destroy();

try {
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete = $bdd->prepare("SELECT * FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :db_name");
		$requete->bindParam(':db_name', $DB_NAME);
		$requete->execute();
		$code = $requete->fetchAll(PDO::FETCH_ASSOC);
    }
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
if ($code == NULL)
{
	try
	{
		$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bdd->query("CREATE DATABASE IF NOT EXISTS $DB_NAME");
		$bdd->query("use $DB_NAME");
		create_user_table($bdd);
		add_users($bdd);
		create_pictures_table($bdd);
		add_pictures($bdd);
		create_likes_table($bdd);
		add_likes($bdd);
		create_comments_table($bdd);
		add_comments($bdd);
		create_filters_table($bdd);
		add_filters($bdd);
	}
	catch (PDOException $e) {
		print "Erreur : ".$e->getMessage()."<br/>";
		die();
	}
	header('Location: ../index.php');
}
else {
	header('Location: ../index.php');
}



?>
