
<section class="header-index">
  <?php 
    require_once __DIR__.'/templates/header.php'; 
    include_once('/config/dbcon.php');
  ?> 

<div class="text-box">
  <h1>Bienvenue dans votre Garage V. Parrot</h1>
  <p>Implantés dans la ville de Toulouse depuis plus de 15ans, nous vous garantissons un service rapide et sur mesure.<br>Confiez votre véhicule à de vrais passionés en toute confiance. </p>
  <a href="contact.php" class="hero-btn">Contactez-nous !</a>
</div>
</section>


<!-- PRESTATIONS -->

<section class="articles">
  <h1>Prestations</h1>
  <div class="row">
    <div class="article-col">
      <img src="assets/repair.png" alt="Reparation carrosserie">
        <h3>Carrosserie</h3>
        <p>Changement d'éléments, camouflage d'égratinures</p>
    </div>
    <div class="article-col">
      <img src="assets/control.png" alt="Reparation mécanique">
        <h3>Mécanique</h3>
        <p>Remplacement de pièces défectueuses</p>
    </div>
    <div class="article-col">
      <img src="assets/clean.png" alt="Entretien voiture">
        <h3>Entretien</h3>
        <p>Nettoyage, vente de produits agréés... <br>Trouvez votre bonheur chez nous !</p>
    </div>
  </div>
</section>


<!--- VEHICULES -->

<section class="banner-vehicules">
  <h2>Découvrez tous nos véhicules d'occasion</h2>
  <a href="vehicules.php" class="btn-vehicules">Véhicules d'occasion</a>
</section>


<!--- AVIS CLIENTS -->

<?php
$db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

// Récupérer les commentaires publiés depuis la base de données
$query = "SELECT * FROM avis WHERE published = true";
$stmt = $db->query($query);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>


<section class="comments">
  <h1>Ce que nos clients disent de nous</h1>
  <div class="row-avis">
    <?php foreach ($commentaires as $commentaire) : ?>
      <div class="comments-col">
        <div>
          <div class="rating">
              <?php for ($i = 0; $i < $commentaire['note']; $i++) : ?>
                <i class="fa fa-star"></i>
              <?php endfor; ?>
            <p><?= $commentaire['message']; ?></p>
              <h4><?= $commentaire['prenom'] . ' ' . $commentaire['nom']; ?></h4>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn" class="comment-btn">Laisser un avis</button>
    
      <!-- The Modal -->
      <div id="myModal" class="modal">
    
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <section class="comment-content">
            <div class="comment-box">
            <h3> Donnez votre avis</h3>
              <form class="form" method="post" action="../ECF-garage/functions/enregistrerAvis.php">
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom"required>
                <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
                <textarea id="message" name="message" rows="4" placeholder="Votre commentaire"required></textarea>
                <label for="note">Note:</label>
                <select id="note" name="note">
                    <option value="1">1 étoile</option>
                    <option value="2">2 étoiles</option>
                    <option value="3">3 étoiles</option>
                    <option value="4">4 étoiles</option>
                    <option value="5">5 étoiles</option>
                </select>
                <br><br>
                <button type="submit" class="hero-btn red-btn">Envoyer l'avis</button>
              </form>
          </section>
        </div>
      </div>
</section>

<!---FOOTER-->

<?php 
    require_once __DIR__.'/templates/footer.php'; 
?> 