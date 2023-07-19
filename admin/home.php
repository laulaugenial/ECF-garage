<?php
session_start();
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];
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
    <h1>Bienvenue sur votre espace professionnel <?php echo $name .' ' . $lastname; ?> !</h1>
</div>

<!-- AJOUTE COMPTE EMPLOYE-->

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
    <?php
            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

              if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
    
                $deleteQuery = "DELETE FROM users WHERE user_id = ?";
                $stmt = $db->prepare($deleteQuery);
                $stmt->execute([$deleteId]);
              }
              // Récupérer les informations des visiteurs depuis la base de données
              $query = "SELECT * FROM users WHERE user_type != 'Admin'";
              $stmt = $db->query($query);
              $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les informations des visiteurs dans un tableau
              echo '<table>';
              echo '<tr>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Action</th>
              </tr>';
              foreach ($users as $user) {
                  echo '<tr>';
                  echo '<td>' . $user['name'] . '</td>';
                  echo '<td>' . $user['lastname'] . '</td>';
                  echo '<td>' . $user['email'] . '</td>';
                  echo '<td><a href="?delete_id=' . $user['user_id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération des comptes : " . $e->getMessage();
              }
              ?>
    </div>
</section>

<!-- MODIFIE HORAIRES -->

<section class="modify">
  <div class="home-row">
    <div class="modify-col">
      <h1>Modifier horaires d'ouverture</h1>
    <?php
      try {
        $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mettre à jour les horaires dans la base de données
            foreach ($_POST['horaires'] as $day => $hours) {
                $query = "UPDATE openingHours SET hours = :hours WHERE day = :day";
                $stmt = $db->prepare($query);
                $stmt->execute(['hours' => $hours, 'day' => $day]);
            }

            echo "Les horaires ont été mis à jour avec succès !";
        }

        // Récupérer les horaires depuis la base de données
        $query = "SELECT * FROM openingHours";
        $stmt = $db->query($query);
        $horaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la récupération des horaires : " . $e->getMessage();
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        // Afficher les horaires dans un formulaire
        foreach ($horaires as $hours) {
            echo '<div class="modify-form">';
            echo '<label for="' . $hours['day'] . '">' . $hours['day'] . '</label>';
            echo '<input type="text" id="' . $hours['day'] . '" name="horaires[' . $hours['day'] . ']" value="' . $hours['hours'] . '"><br><br>';
            echo '</div>';
        }
        ?>

        <button type="submit" class="add-btn red-btn">Enregistrer</button>
    </form>
</section>
</body>
</html>
