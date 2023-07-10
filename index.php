
<section class="header-index">
  <?php 
    require_once __DIR__.'/templates/header.php'; 
  ?> 
<?php
        if(isset($SESSION['message']))
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

<div class="text-box">
  <h1>Bienvenue dans votre Garage V. Parrot</h1>
  <p>Implantés dans la ville de Toulouse depuis plus de 15ans, nous vous garantissons un service rapide et sur mesure.<br>Confiez votre véhicule à de vrais passionés en toute confiance. </p>
  <a href="contact.php" class="hero-btn">Contactez-nous !</a>
</div>
</section>


<!--PRESTATIONS-->
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


<!---COMMENTS-->

<section class="comments">
  <h1>Ce que nos clients disent de nous</h1>
  <div class="row">
    <div class="comments-col">
      <div>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-half"></i>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut asperiores quisquam 
          distinctio voluptatibus sint obcaecati quidem pariatur atque totam? Sequi impedit 
          nesciunt fuga illum, perspiciatis ullam quisquam iusto quia tempora?</p>
        <h4>Nom 1</h4>
      </div>
    </div>
    <div class="comments-col">
      <div>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-half"></i>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut asperiores quisquam 
          distinctio voluptatibus sint obcaecati quidem pariatur atque totam? Sequi impedit 
          nesciunt fuga illum, perspiciatis ullam quisquam iusto quia tempora?</p>
        <h4>Nom 2</h4>
      </div>
    </div>
  </div>
  <div>
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
              <form class="form">
                <input type="text" placeholder="Entrez votre nom">
                <input type="email" placeholder="Entrez votre email">
                <input type="text" placeholder="Notez votre commentaire de 1 à 5">
                <textarea rows="5" placeholder="Votre commentaire"></textarea>
                <button type="submit" class="hero-btn red-btn">Envoyer l'avis</button>
              </form>
          </div>
          </section>
        </div>
      </div>
    </div>
</section>

<!---FOOTER-->

<?php 
    require_once __DIR__.'/templates/footer.php'; 
?> 



<?php
try
{
	$db = new PDO('pgsql:host=localhost;port=5432;dbname=ECF;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>