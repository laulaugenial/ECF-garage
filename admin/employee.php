<?php
session_start();
include_once('../config/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V. Parrot</title>
    <link rel="icon" href="../assets/favicon.svg" type="image/svg">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

<body>
<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
<nav class="header">
      <a href="../index.php"><img src="../assets/logo.png"></a>
      <div class="nav-links" id="navLinks">
      </div>
</nav>

<div class="container">
    <?php echo 'Bienvenue sur votre espace professionnel' . $name['name'] .$lastname['lastname'] ?>
</div>
<section class="modify">
  <div class="row">
    
    <div class="modify-col">
    <h1> Ajouter une voiture</h1>
      <form class="modify-form" action="../functions/addCar.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="carbrand" placeholder="Marque de la voiture" required>
        <input type="text" name="year" placeholder="Année mise en circulation">
        <input type="text" name="fuel" placeholder="Type d'essence">
        <input type="text" name="km" placeholder="Nombre de km">
        <input type="text" name="price" placeholder="Prix en €"required>
        <input type="text" name="infos" placeholder="Informations supplémentaires">
        <button type="submit" name="ajouter" class="add-btn red-btn">Ajouter</button>
      </form>

      <form class="modify-form" action="../functions/addCar.php" enctype="multipart/form-data" method="POST">
      <input type="file" name="choosefile" value="">
      <button type="submit" name="uploadfile">Ajouter image</button>
      </form>
    </div>
  

    
    <div class="modify-col">
      <h1>Espace commentaires</h1>
        <form class="modify-form" action="../templates/footer.php" method="POST">
            <input type="text" name="name" placeholder="Nom du commentaire" required>
            <input type="text" name="comment" placeholder="Contenu du commentaire"required>
            <input type="text" name="grade" placeholder="Nombre d'étoiles"required>
            <button type="submit" name="addHours" class="add-btn red-btn">Ajouter</button>
        </form>
    </div>
  </div>
</section>

</body>
</html>