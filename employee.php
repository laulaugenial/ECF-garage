<?php
session_start();
$name = $_SESSION['name'];
$lastname = $_SESSION['lastname'];


// Vérifie si l'utilisateur est authentifié
function isUserAuthenticated() {
  return isset($_SESSION['user_id']);
}

// Redirige l'utilisateur vers la page de login s'il n'est pas authentifié
function redirectToLogin() {
  header('Location: login.php');
  exit();
}

// Authentifie l'utilisateur (à appeler lorsqu'il se connecte)
function authenticateUser($userId) {
  $_SESSION['user_id'] = $userId;
}

// Déconnecte l'utilisateur (à appeler lorsqu'il se déconnecte)

function logoutUser() {
  session_unset();
  session_destroy();
  redirectToLogin();
}
if (isset($_POST['logout'])) {
  logoutUser();
}
// Vérifie si l'utilisateur est authentifié, sinon le redirige vers la page de login
if (!isUserAuthenticated()) {
    redirectToLogin();
}

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
      <form class="logout" method="post">
        <input class="hero-btn red-btn" type="submit" name="logout" value="Déconnexion">
    </form>
      <div class="nav-links" id="navLinks">
      </div>
</nav>

<div class="container">
    <h1>Bienvenue sur votre espace professionnel <?php echo $name .' ' . $lastname; ?> !</h1>
</div>


<!-- AJOUTE VOITURE-->

<?php
include __DIR__.'/functions/addCar.php';
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

    <?php
    try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

              if (isset($_GET['supprimerVoiture'])) {
                $suppr = $_GET['supprimerVoiture'];
    
                $supprCar = "DELETE FROM car WHERE car_id = ?";
                $carDB = $db->prepare($supprCar);
                $carDB->execute([$suppr]);
              }

              // Récupérer les avis publiés depuis la base de données
              $carID = "SELECT * FROM car";
              $assbl = $db->query($carID);
              $carRecs = $assbl->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les informations des visiteurs dans un tableau
              echo '<div class="modify-col">';
              echo '<h1>Anonces voitures publiées</h1>';
              echo '<table>';
              echo '<tr>
              <th>Marque</th>
              <th>Prix</th>
              <th>Action</th>
              </tr>';
              foreach ($carRecs as $carRec) {
                  echo '<tr>';
                  echo '<td data-label="Marque">' . $carRec['carbrand'] . '</td>';
                  echo '<td data-label="Prix">' . $carRec['price'] . '</td>';
                  echo '<td data-label="Action"><a href="?supprimerVoiture=' . $carRec['car_id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              echo '</div>';
          
        } catch (PDOException $e) {    
          $errorMessage = "Erreur PDO : ";
          error_log($errorMessage, 3, '../ECF-garage/logs/error.log');
          echo "Une erreur s'est produite lors de la récupération des avis";
        }
?>
</section>
  

    <!-- CREE AVIS -->
<section class="modify">
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
</section>

  <!-- RECUPERE AVIS CLIENTS-->

<section class="container-array">
    <div class="modify-col">
      <div class="array">
        <h1>Nouveaux Avis clients</h1>
            <?php
            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

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
                  echo '<td data-label="Prénom">' . $commentaire['prenom'] . '</td>';
                  echo '<td data-label="Nom">' . $commentaire['nom'] . '</td>';
                  echo '<td data-label="Email">' . $commentaire['email'] . '</td>';
                  echo '<td data-label="Message">' . $commentaire['message'] . '</td>';
                  echo '<td data-label="Note">' . $commentaire['note'] . '</td>';
                  echo '<td data-label="Action"><a href="?publish_id=' . $commentaire['id'] . '">Publier</a>
                  <a href="?delete_id=' . $commentaire['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
                }
              echo '</table>';
              echo '<br>';

              // Si on clique sur Publier, la table est mise à jour
              if (isset($_GET['publish_id'])) {
                $publishId = $_GET['publish_id'];
            
                $publishQuery = "UPDATE avis SET published = TRUE WHERE id = ?";
                $stmt = $db->prepare($publishQuery);
                $stmt->execute([$publishId]);
              }

              // Supprime avis reçus de la BDD
              if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
    
                $deleteQuery = "DELETE FROM avis WHERE id = ?";
                $stmt = $db->prepare($deleteQuery);
                $stmt->execute([$deleteId]);
              }
              ?>
        </div>
      </div>
</section>

<section class="container-array">
    <div class="modify-col">
      <div class="array">
        <?php
              // TABLEAU AVIS PUBLIES
              
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
                  echo '<td data-label="Nom">' . $resume['nom'] . '</td>';
                  echo '<td data-label="Note">' . $resume['note'] . '</td>';
                  echo '<td data-label="Message">' . $resume['message'] . '</td>';
                  echo '<td data-label="Action"><a href="?supprimerAvis=' . $resume['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';

              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération des avis : ";
              }

              // Supprime Avis publiés
              if (isset($_GET['supprimerAvis'])) {
                $delete = $_GET['supprimerAvis'];
    
                $deleteAvis = "DELETE FROM avis WHERE id = ?";
                $base = $db->prepare($deleteAvis);
                $base->execute([$delete]);
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
                  echo '<td data-label="Prénom">' . $visiteur['name'] . '</td>';
                  echo '<td data-label="Nom">' . $visiteur['lastname'] . '</td>';
                  echo '<td data-label="Email">' . $visiteur['mail'] . '</td>';
                  echo '<td data-label="Téléphone">' . $visiteur['phone'] . '</td>';
                  echo '<td data-label="Voiture">' . $visiteur['car'] . '</td>';
                  echo '<td data-label="Message">' . $visiteur['message'] . '</td>';
                  echo '<td data-label="Action"><a href="?delete_id=' . $visiteur['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération du formulaire : ";
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
                  echo '<td data-label="Prénom">' . $visiteur['name'] . '</td>';
                  echo '<td data-label="Nom"' . $visiteur['lastname'] . '</td>';
                  echo '<td data-label="Email">' . $visiteur['mail'] . '</td>';
                  echo '<td data-label="Téléphone">' . $visiteur['phone'] . '</td>';
                  echo '<td data-label="Message">' . $visiteur['message'] . '</td>';
                  echo '<td data-label="Action"><a href="?delete_id=' . $visiteur['id'] . '">Supprimer</a></td>';
                  echo '</tr>';
              }
              echo '</table>';
              } catch (PDOException $e) {
              echo "Une erreur s'est produite lors de la récupération des visiteurs : ";
              }
              ?>
      
      </div>
    </div>
</section>

</body>
</html>