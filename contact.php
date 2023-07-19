<section class="header">
<?php 
    require_once __DIR__.'/templates/header.php'; 
    header("Set-Cookie: cross-site-cookie=whatever; SameSite=None; Secure");
    $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

?> 
</section>

<section class="contact">
  <div class="row">
    <div class="contact-col">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.3616168457356!2d1.4644200768681617!3d43.59901175593275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12aebcf20f5ac0dd%3A0xffe6b8c52d070976!2sRue%20des%20Marronniers%2C%2031500%20Toulouse!5e0!3m2!1sfr!2sfr!4v1687365600878!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="contact-col">
      <h1>À propos</h1>
      <p>Fort de ses 15 années d'expérience dans la réparation automobile, <b>Vincent Parrot</b> a ouvert
        son propre garage à Toulouse en 2021. <br>Son atelier est un véritable lieu de confiance pour ses
         clients, et leurs voitures doivent, selon lui, à tout prix être entre de bonnes mains.
      </p>
      <h1>Contactez-nous</h1>
      <p>Contactez-nous par téléphone au <b>01 02 03 04 05</b> ou en remplissant le formulaire ci-dessous, nous vous contacterons dans les plus brefs délais.</p>

      <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $message = $_POST['message'];

        // Valider les données
        if (empty($prenom) || empty($nom) || empty($email) || empty($message)) {
            echo "Veuillez remplir tous les champs obligatoires.";
        } else {

            try {
              $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

                // Préparer et exécuter la requête d'insertion des données
                $query = "INSERT INTO contactForm (name, lastname, mail, phone, message) VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->execute([$prenom, $nom, $email, $telephone, $message]);

                echo "Votre message a été envoyé avec succès !";
            } catch (PDOException $e) {
                echo "Une erreur s'est produite lors de l'envoi du message : " . $e->getMessage();
            }
        }
    }
    ?>
    
    <h1>Formulaire de contact</h1>
    
    <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" id="prenom" name="prenom" placeholder="Votre Prénom" required>
        <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
        <input type="email" id="email" name="email" placeholder="Votre adresse mail"required>
        <input type="text" id="telephone" name="telephone" placeholder="Votre téléphone">
        <textarea id="message" name="message" rows="4" placeholder="Votre message" required></textarea>
        <button class="hero-btn red-btn" type="submit">Envoyer</button>
    </form>
</div>
</section>


<!---FOOTER-->

<?php 
    require_once __DIR__.'/templates/footer.php'; 
?> 