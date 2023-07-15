<?php 
session_start();
include('../config/dbcon.php'); ?>

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
<nav class="header">
      <a href="../index.php"><img src="../assets/logo.png"></a>
      <div class="nav-links" id="navLinks">
      </div>
</nav>

<section class="container">

<?php
        if(isset($_SESSION['message']))
        {
            ?>
            <div class="alert">
                <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                <button type="button" aria-label="close"></button>
            </div>
            <?php
            unset($_SESSION['message']);
        }
        ?>


    <h1>Connectez-vous à votre espace professionnel</h1>
    <div class="container-content">
        <form action="../functions/authcode.php" method="POST">
            <div class="form">
                <label for=" email">Email :</label>
                <input type="email" name="email" placeholder="Entrez votre email" required>
                <label for="pass">Mot de passe :</label>
                <input type="password" placeholder="Saisissez votre mot de passe" id="pass" name="password" minlength="8" required>
                <button type="submit" name="login-btn" class="login-btn">Se connecter</button>
            </div>
        </form>
    </div>
</section>

</body>
</html>