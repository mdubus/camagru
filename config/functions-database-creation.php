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
}




?>
