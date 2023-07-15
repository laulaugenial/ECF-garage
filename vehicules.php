<section class="header">
  <?php 
    require_once __DIR__.'/templates/header.php';
  ?> 

</section>


<section class="sales-articles">
  <h1>Nos véhicules d'occasion à la vente</h1>
  <div class="row-sales">
    <div class="sales-col">
      <img src="assets/repair.png" alt="Reparation carrosserie">
          <h3>Opel Corsa 1.3 CDCI 75 CH DIESEL</h3>
          <p>Année : 2008</p>
          <p>Diesel</p>
          <p>177220 km</p>
          <h4>4790€</h4>
          <button id="myBtn" class="comment-btn">Nous contacter</button>
                  <!-- Modal content -->
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <section class="comment-content">
                <div class="comment-box">
                  <h3>Ref nom voiture</h3>
                  <form class="form">
                    <input type="text" placeholder="Nom et Prénom">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Numéro de téléphone">
                    <textarea rows="5" placeholder="Message"></textarea>
                    <button type="submit" class="hero-btn red-btn">Envoyer</button>
                  </form>
                </div>
              </section>
            </div>
          </div>
    </div>
    <div class="sales-col">
      <img src="assets/repair.png" alt="Reparation carrosserie">
        <h3>Land Rover Freelander SX 112 CH 4x4</h3>
        <p>Année : 2001</p>
        <p>Diesel</p>
        <p>184200 km</p>
        <h4>7290€</h4>
        <button id="myBtn" class="comment-btn">Nous contacter</button>
         <!-- Modal content -->
          <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <section class="comment-content">
                <div class="comment-box">
                  <h3>Ref nom voiture</h3>
                  <form class="form">
                    <input type="text" placeholder="Nom et Prénom">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Numéro de téléphone">
                    <textarea rows="5" placeholder="Message"></textarea>
                    <button type="submit" class="hero-btn red-btn">Envoyer</button>
                  </form>
                </div>
              </section>
            </div>
          </div>
    </div>
    <div class="sales-col">
      <img src="assets/repair.png" alt="Reparation carrosserie">
        <h3>Volkswagen Polo 1.6 TDI 75CH</h3>
        <p>Année : 2010</p>
        <p>Diesel</p>
        <p>177261 km</p>
        <h4>6140€</h4>
        <button id="myBtn" class="comment-btn">Nous contacter</button>
         <!-- Modal content -->
           <div id="myModal" class="modal">
            <div class="modal-content">
              <span class="close">&times;</span>
              <section class="comment-content">
                <div class="comment-box">
                  <h3>Ref nom voiture</h3>
                  <form class="form">
                    <input type="text" placeholder="Nom et Prénom">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Numéro de téléphone">
                    <textarea rows="5" placeholder="Message"></textarea>
                    <button type="submit" class="hero-btn red-btn">Envoyer</button>
                  </form>
                </div>
              </section>
            </div>
          </div>
    </div>
    <?php
      $db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);
      $req=$db->query("SELECT * FROM car ORDER BY car_id DESC");

      while($aff=$req->fetch()){?>

    <div class="sales-col">
      <img src="assets/repair.png" alt="Reparation carrosserie">
        <h3><?php echo $aff['carbrand']?></h3>
        <p>Année : <?php echo $aff['year']?></p>
        <p><?php echo $aff['fuel']?></p>
        <p><?php echo $aff['km']?> km</p>
        <h4><?php echo $aff['price']?>€</h4>
        <button id="myBtn" class="comment-btn">Nous contacter</button>
    </div>
        <?php } ?>

    

</section>

<!---FOOTER-->

<?php 
    require_once __DIR__.'/templates/footer.php'; 
?>