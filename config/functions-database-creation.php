<?PHP

function create_user_table($bdd)
{
$bdd->query("CREATE TABLE IF NOT EXISTS utilisateurs (
	id INT PRIMARY KEY AUTO_INCREMENT,
	login VARCHAR(255) UNIQUE,
	mail VARCHAR(255) UNIQUE,
	groupe VARCHAR(20),
	mdp VARCHAR(255),
	token VARCHAR(255))");
}

function	add_users($bdd)
{
$bdd->query("LOAD DATA INFILE '/Users/mdubus/http/MyWebSite/camagru/config/utilisateurs.csv'
INTO TABLE `utilisateurs`
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\r\n'
IGNORE 1 LINES (login,mail,groupe,mdp,token)");
}


function	create_pictures_table($bdd)
{
$bdd->query("CREATE TABLE IF NOT EXISTS photos (
	id_photo INT PRIMARY KEY AUTO_INCREMENT,
	date_upload INT,
	link VARCHAR(255) UNIQUE,
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES utilisateurs(id)
)");
}

function	add_pictures($bdd)
{
	$bdd->query("LOAD DATA INFILE '/Users/mdubus/http/MyWebSite/camagru/config/photos.csv'
	INTO TABLE `photos`
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (link,id_user)");

	$date_upload = time();
	include '../config/database.php';
	$bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$bdd->query("USE camagru");
	$requete = $bdd->prepare("UPDATE `photos` SET `date_upload` = :date_upload");
	$requete->bindParam(':date_upload', $date_upload);
	$requete->execute();
}

function	create_likes_table($bdd)
{
$bdd->query("CREATE TABLE IF NOT EXISTS likes (
	id_likes INT PRIMARY KEY AUTO_INCREMENT,
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES utilisateurs(id),
	id_photo INT,
	FOREIGN KEY (id_photo) REFERENCES photos(id_photo)
)");
}

function	add_likes($bdd)
{
	$bdd->query("LOAD DATA INFILE '/Users/mdubus/http/MyWebSite/camagru/config/likes.csv'
	INTO TABLE `likes`
	FIELDS TERMINATED BY ','
	LINES TERMINATED BY '\r\n'
	IGNORE 1 LINES (id_user,id_photo)");
}



function	create_comments_table($bdd)
{
$bdd->query("CREATE TABLE IF NOT EXISTS comments (
	id_comments INT PRIMARY KEY AUTO_INCREMENT,
	id_user INT,
	FOREIGN KEY (id_user) REFERENCES utilisateurs(id),
	id_photo INT,
	FOREIGN KEY (id_photo) REFERENCES photos(id_photo)
)");
}


?>
