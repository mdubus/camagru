<?php
include 'database.php';
include 'functions-database-creation.php';
session_start();
session_destroy();
try {
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


}
catch (PDOException $e) {
	print "Erreur : ".$e->getMessage()."<br/>";
	die();
}

echo "<meta http-equiv='refresh' content='0,url=../index.php'>";
?>
