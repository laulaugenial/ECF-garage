<section class="footer">
  <div class="nav-footer">
    <h4>Où nous trouver</h4>
    <p>15 rue des marronniers<br>31500 Toulouse</p>
    <h4>Téléphone</h4>
    <p>01 02 03 04 05</p>
  </div>
  <div class="nav-footer">
    <a href="index.php"><h4>Accueil</h4></a>
    <a href="repair.php"><h4>Réparations</h4></a>
    <a href="clean.php"><h4>Entretien</h4></a>
    <a href="vehicules.php"><h4>Véhicules d'occasion</h4></a>
    <a href="contact.php"><h4>Contact</h4></a>
    <a href="admin/login.php"><h4>Espace pro</h4></a>
  </div>
  <div class="nav-footer">
    <h4>Horaires d'ouverture</h4>
    <?php
    $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

    $req=$db->query("SELECT * FROM openingHours ORDER BY id_hours");
    while ($aff=$req->fetch()){?>

        <p><b><?php echo $aff['day']?></b><?php echo $aff['hours']?></p>

      <?php } ?>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
<script src="JS/main.js"></script>
</body>
</html>