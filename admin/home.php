<?php
session_start();
include('../config/dbcon.php');
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


<section class="modify">
  <div class="home-row">
    
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
    <h1>Comptes existants</h1>
      <table>
        <th>Nom</th>
        <th>Prénom
        <th>Mail</th>
        </th>
        <?php
        $req=$db->query("SELECT * FROM users");
        while($aff=$req->fetch()){?>

        <tr>
          <td><?php echo $aff['name']?></td>
          <td><?php echo $aff['lastname']?></td>
          <td><?php echo $aff['email']?></td>
          <td>
            <a href="deleteEmployee.php?id=<?php echo $aff['id'] ?>">Supprimer</a>
        </tr>
        <?php } ?>
      </table>
    </div>
</section>

<section class="modify">
  <div class="home-row">
    <div class="modify-col">
      <h1>Modifier horaires d'ouverture</h1>
        <form class="modify-form" action="../functions/addHours.php" method="POST">
          <div class="deroulant">
            <label for="day">Jour de la semaine</label>
                <select name="day" id="day">
                  <option value="">Sélectionnez un jour de semaine</option>
                  <option value="Lundi">Lundi</option>
                  <option value="Mardi">Mardi</option>
                  <option value="Mercredi">Mercredi</option>
                  <option value="Jeudi">Jeudi</option>
                  <option value="Vendredi">Vendredi</option>
                  <option value="Samedi">Samedi</option>
                  <option value="Dimanche">Dimanche</option>
                </select>
          </div>
          <label for="hours">Entrer les nouveaux horaires :</label>
          <input type="text" name="hours" placeholder="Format 08:00 - 12:00, 14:00 18:00"required>
          <button type="submit" name="addHours" class="add-btn red-btn">Ajouter</button>
        </form>
    </div>
  </div>

</section>
</body>
</html>
