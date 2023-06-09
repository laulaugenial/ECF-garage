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


<?php echo 'Bienvenue sur votre espace professionnel' . $name['name'] .$lastname['lastname'] ?>


<section class="modify">
  <div class="row">
    
    <div class="modify-col">
    <h1> Ajouter un compte Employé</h1>
      <form class="modify-form" action="../functions/addEmployee.php" method="POST">
        <input type="text" name="name" placeholder="Prénom" required>
        <input type="text" name="lastname" placeholder="Nom"required>
        <input type="email" name="email" placeholder="Email"required>
        <input type="password" id="pass" name="password" minlength="8" placeholder="Mot de passe"required>
        <button type="submit" name="ajouter" class="add-btn red-btn">Ajouter</button>
      </form>
    </div>
  

    
    <div class="modify-col">
      <h1>Modifier horaires d'ouverture</h1>
        <form class="modify-form" action="../templates/footer.php" method="POST">
            <label for="day">Entrer le jour de la semaine :</label>
            <input type="text" name="day" placeholder="Jour de la semaine" required>
            <label for="morning">Entrer les horaires de la matinée :</label>
            <input type="text" name="morning" placeholder="Format 08:00 - 12:00"required>
            <label for="evening">Entrer les horaires de l'après-midi :</label>
            <input type="text" name="evening" placeholder="Format 14:00 - 18:00"required>
            <button type="submit" name="addHours" class="add-btn red-btn">Ajouter</button>
        </form>
    </div>
  </div>


</section>
</body>
</html>
