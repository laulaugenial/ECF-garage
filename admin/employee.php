<?php
session_start();
include_once('../config/dbcon.php');
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

<!-- AJOUTE VOITURE-->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $carbrand = $_POST['carbrand'];
        $year = $_POST['year'];
        $fuel = $_POST['fuel'];
        $km = $_POST['km'];
        $price = $_POST['price'];
        $infos = $_POST['infos'];

        if (isset($_POST['ajouter'])) {
 
          $filename = $_FILES["image"]["name"];
          $tempname = $_FILES["image"]["tmp_name"];
          $folder = "uploads/" . $filename;
       
          $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

        
            // Insérer les données dans la base de données
            $query = "INSERT INTO car (carbrand, year, fuel, km, price, infos, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$carbrand, $year, $fuel, $km, $price, $infos, $filename]);
          
            // Now let's move the uploaded image into the folder: image
            if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image téléchargée avec succès !</h3>";
            } else {
            echo "<h3>  Failed to upload image!</h3>";
            }

            echo "Le véhicule a été ajouté avec succès !"; 
          }
      }
?>

<section class="modify">
  <div class="row">    
    <div class="modify-col">
    <h1> Ajouter une voiture</h1>
      <form class="modify-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="POST">
        <input type="text" name="carbrand" placeholder="Marque de la voiture" required>
        <input type="text" name="year" placeholder="Année mise en circulation">
        <input type="text" name="fuel" placeholder="Type d'essence">
        <input type="text" name="km" placeholder="Nombre de km">
        <input type="text" name="price" placeholder="Prix"required>
        <input type="text" name="infos" placeholder="Informations supplémentaires">
        <input type="file" id="image" placeholder="Choisir une photo" name="image">
        <button type="submit" name="ajouter" class="add-btn red-btn">Ajouter</button>
      </form>
    </div>
  
  

    <!-- CREE AVIS -->

    <div class="modify-col">
      <h1>Ajouter un commentaire</h1>
        <form class="modify-form" action="../commentApproved.php" method="POST">
            <input type="text" name="firstname" placeholder="Prénom de l'auteur" required>
            <input type="text" name="lastname" placeholder="Nom de l'auteur" required>
            <input type="text" name="comment" placeholder="Contenu du commentaire"required>
            <label for="grade">Nombre d'étoiles</label>
            <select name="grade" id="grade">
              <option value="">Sélectionnez</option>
              <option value="1">1 étoiles</option>
              <option value="2">2 étoiles</option>
              <option value="3">3 étoiles</option>
              <option value="4">4 étoiles</option>
              <option value="5">5 étoiles</option>
            </select>
            <br>
            <button type="submit" name="addHours" class="add-btn red-btn">Ajouter</button>
        </form>
    </div>
  </div>


  <!-- RECUPERE AVIS CLIENTS-->

  <section class="container-array">
    <div class="modify-col">
      <div class="array">
        <h1>Avis clients</h1>
            <?php
            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

              if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
    
                $deleteQuery = "DELETE FROM avis WHERE id = ?";
                $stmt = $db->prepare($deleteQuery);
                $stmt->execute([$deleteId]);
              }

              // Si on clique sur Publier, la table est mise à jour
              if (isset($_GET['publish_id'])) {
                $publishId = $_GET['publish_id'];
            
                $publishQuery = "UPDATE avis SET published = TRUE WHERE id = ?";
                $stmt = $db->prepare($publishQuery);
                $stmt->execute([$publishId]);
              }

              // Récupérer les avis depuis la base de données
              $query = "SELECT * FROM avis WHERE published = false";
              $stmt = $db->query($query);
              $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les avis dans un tableau
              echo '<table>';
              echo '<tr>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Email</th>
              <th class="message">Message</th>
              <th>Note</th>
              <th>Action</th>
              </tr>';
              foreach ($commentaires as $commentaire) {
                  echo '<tr>';
                  echo '<td>' . $commentaire['prenom'] . '</td>';
                  echo '<td>' . $commentaire['nom'] . '</td>';
                  echo '<td>' . $commentaire['email'] . '</td>';
                  echo '<td>' . $commentaire['message'] . '</td>';
                  echo '<td>' . $commentaire['note'] . '</td>';
                  echo '<td><a href="?publish_id=' . $commentaire['id'] . '">Publier</a>
                  <a href="?delete_id=' . $commentaire['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
                }
              echo '</table>';


              if (isset($_GET['supprimerAvis'])) {
                $delete = $_GET['supprimerAvis'];
    
                $deleteAvis = "DELETE FROM avis WHERE id = ?";
                $base = $db->prepare($deleteAvis);
                $base->execute([$delete]);
              }
              // Affiche tableau des avis publiés
              
              // Récupérer les avis publiés depuis la base de données
              $res = "SELECT * FROM avis WHERE published = true";
              $recup = $db->query($res);
              $resumes = $recup->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les informations des visiteurs dans un tableau
              echo '<br>';
              echo '<h1>Avis publiés</h1>';
              echo '<table>';
              echo '<tr>
              <th>Nom</th>
              <th>Note</th>
              <th>Message</th>
              <th>Action</th>
              </tr>';
              foreach ($resumes as $resume) {
                  echo '<tr>';
                  echo '<td>' . $resume['nom'] . '</td>';
                  echo '<td>' . $resume['note'] . '</td>';
                  echo '<td>' . $resume['message'] . '</td>';
                  echo '<td><a href="?supprimerAvis=' . $resume['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';

              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération des avis : " . $e->getMessage();
              }

              
              ?>
      </div>
    </div>
  </section>



  <!-- RECUPERE FORMULAIRES RENSEIGNEMENTS VOITURES-->

  <section class="container-array">
    <div class="modify-col">
      <div class="array">
        <h1>Renseignement voiture</h1>
        <?php
            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

              if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
    
                $deleteQuery = "DELETE FROM carForm WHERE id = ?";
                $stmt = $db->prepare($deleteQuery);
                $stmt->execute([$deleteId]);
              }

              // Récupérer les demandes renseignement depuis la base de données
              $query = "SELECT * FROM carForm";
              $stmt = $db->query($query);
              $visiteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les informations dans un tableau
              echo '<table>';
              echo '<tr>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Voiture</th>
              <th>Message</th>
              <th>Action</th>
              </tr>';
              foreach ($visiteurs as $visiteur) {
                  echo '<tr>';
                  echo '<td>' . $visiteur['name'] . '</td>';
                  echo '<td>' . $visiteur['lastname'] . '</td>';
                  echo '<td>' . $visiteur['mail'] . '</td>';
                  echo '<td>' . $visiteur['phone'] . '</td>';
                  echo '<td>' . $visiteur['car'] . '</td>';
                  echo '<td>' . $visiteur['message'] . '</td>';
                  echo '<td><a href="?delete_id=' . $visiteur['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération du formulaire : " . $e->getMessage();
              }
              ?>
      </div>
    </div>
  </div>
</section>


<!-- RECUPERE FORMULAIRES PRISE CONTACT-->

<section class="container-array">
    <div class="modify-col">
      <div class="array">
        <h1>Prise de contact</h1>
            <?php
            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

              if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
    
                $deleteQuery = "DELETE FROM contactForm WHERE id = ?";
                $stmt = $db->prepare($deleteQuery);
                $stmt->execute([$deleteId]);
              }

              // Récupérer les informations des visiteurs depuis la base de données
              $query = "SELECT * FROM contactForm";
              $stmt = $db->query($query);
              $visiteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les informations des visiteurs dans un tableau
              echo '<table>';
              echo '<tr>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th class="message">Message</th>
              <th>Action</th>
              </tr>';
              foreach ($visiteurs as $visiteur) {
                  echo '<tr>';
                  echo '<td>' . $visiteur['name'] . '</td>';
                  echo '<td>' . $visiteur['lastname'] . '</td>';
                  echo '<td>' . $visiteur['mail'] . '</td>';
                  echo '<td>' . $visiteur['phone'] . '</td>';
                  echo '<td>' . $visiteur['message'] . '</td>';
                  echo '<td><a href="?delete_id=' . $visiteur['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération des visiteurs : " . $e->getMessage();
              }
              ?>
      
      </div>
    </div>
</section>

</body>
</html>