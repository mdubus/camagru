<?PHP session_start();?>

<!DOCTYPE html>
<html>
<head>
<style>
@import url('https://fonts.googleapis.com/css?family=Merienda+One');
@import url('https://fonts.googleapis.com/css?family=Open+Sans');

</style>
<link rel="stylesheet" type="text/css" href="css/global.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<meta name="google" content="notranslate" />
<title>Accueil - Camagru</title>
</head>


<body>
  <?php
	$current_page = "accueil";
  include "header.php";
	echo $_SESSION['identifiant'];
  ?>
  <div class="center">

  <p class="text">Cupcake ipsum dolor sit amet tart. Sugar plum marshmallow
    cupcake jelly-o sugar plum chocolate bar chocolate bar jelly. Macaroon
    carrot cake pudding gingerbread jelly-o tootsie roll. Lollipop pudding
    cookie pastry chocolate cake apple pie candy caramels cake. Candy jujubes
    cotton candy brownie cheesecake icing fruitcake icing candy. Sugar plum
    jelly-o liquorice jujubes icing chocolate jujubes tart.</p><br/>
    <img src="img/catmagru.png" id="home" alt="Catmagru"><br/>
<p class="text">Oat cake muffin donut croissant candy canes danish cake.
  Donut dragée toffee gingerbread carrot cake candy canes. Biscuit chocolate
  cake sweet dragée powder carrot cake sweet. Sugar plum chocolate halvah cotton
  candy sugar plum. Gummies gummi bears tart danish danish gummies lemon drops
  liquorice. Dragée cake jelly beans candy canes. Chupa chups gummi bears ice
  cream cotton candy biscuit. Pudding gummies sweet roll marshmallow cupcake
  fruitcake. Gingerbread icing sesame snaps. Chocolate cake dragée chocolate
  cake chupa chups croissant sesame snaps brownie chocolate bar.</p>
<p class="text">Cupcake icing cupcake. Sweet fruitcake jujubes cheesecake bonbon.
   Carrot cake fruitcake pudding dragée icing. Croissant candy canes pie tiramisu
    icing cotton candy. Macaroon jelly beans jelly-o powder gingerbread icing
    chocolate pie sweet roll. Sugar plum topping muffin.</p></div>

</body>
</html>
