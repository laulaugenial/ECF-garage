<section class="header">
<?php 
    require_once __DIR__.'/templates/header.php'; 
    include __DIR__.'/config/dbcon.php';
  ?> 

</section>

<script>
$(document).ready(function(){
  $("#marque, #prix-min, #prix-max").on("input", function() {
    var marqueFilter = $("#marque").val().toLowerCase();
    var minPrice = parseFloat($("#prix-min").val()) || 0;
    var maxPrice = parseFloat($("#prix-max").val()) || Number.POSITIVE_INFINITY;

    $(".sales-col").each(function() {
      var isVisible = true;

      // Filtrer par marque
      if (marqueFilter.length > 0) {
        var marqueText = $(this).text().toLowerCase();
        isVisible = marqueText.indexOf(marqueFilter) > -1;
      }

      // Filtrer par prix
      if (isVisible) {
        var prixText = $(this).find(".prix").text().trim();
        var prix = parseFloat(prixText.replace(/[^\d.]/g, ''));

        var isPriceValid = !isNaN(prix) && isFinite(prix);

        isVisible = isPriceValid && minPrice <= prix && prix <= maxPrice;
      }

      $(this).toggle(isVisible);
    });
  });
});

</script>


<section class="sales-articles">
  <h1>Nos véhicules d'occasion à la vente</h1>
    <div class="car-filter">
      <h2>Affinez votre recherche</h2>
      <form id="filtres-form" class="filtres">
          <label for="marque">Marque:</label>
          <input type="text" id="marque" name="marque">
          <label for="prix-min">Prix minimum :</label>
          <input type="text" id="prix-min" name="prix-min">
          <label for="prix-max">Prix maximum :</label>
          <input type="text" id="prix-max" name="prix-max">
      </form>
    </div>

  <div class="row-sales">

    <?php
    $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);
    $req=$db->query("SELECT * FROM car ORDER BY car_id DESC");

    while($aff=$req->fetch()) {

      echo '<div class="sales-col">';
      $imagePath = '/assets/uploads/' . $aff['image'];
      echo '<img src="' . $imagePath . '" alt="Image de la voiture à vendre">';
      echo '<h3 class="brand">' . $aff['carbrand'] . '</h3>';
      echo '<p>Année :' . $aff['year'] . '</p>';
      echo '<p>' . $aff['fuel'] . '</p>';
      echo '<p class="kilometrage">' . $aff['km'] . 'km</p>';
      echo '<h4 class="prix">' . $aff['price'] . '€</h4>';
      echo '<p>' . $aff['infos'] . '</p>';
      echo '</div>';
  }
      
      ?>
  </div>
</section>

<section class="sales-articles">
  <div class="car-filter">
    <div class="modify-col">
      <h2>Une question sur une voiture en particulier ?</h2>
      <form class="modify-form" action="/functions/carForm.php" method="POST">
            
            <label for="chosen">Choisir la voiture</label>
              <select id="chosen" name="chosen">
                    <option value="choose">-- Sélectionner parmi la liste --</option>
              <?php $form=$db->query("SELECT carbrand FROM car");
              while($link=$form->fetch()) { ?>
                    
                    <option value="<?php echo $link['carbrand'] ?>"><?php echo $link['carbrand'] ?></option>
                    <?php } ?>
              </select>

            <input type="text" name="name" placeholder="Prénom" required>
            <input type="text" name="lastname" placeholder="Nom"required>
            <input type="email" name="email" placeholder="Email"required>
            <input type="text" name="phone" placeholder="Numéro de téléphone"required>
            <input type="text" name="message" placeholder="Message"required>
            <br>
            <button type="submit" name="ajouter" class="add-btn red-btn">Envoyer</button>
      </form>
    </div>
  </div>

</section>

<!---FOOTER-->

<?php 
    require_once __DIR__.'/templates/footer.php'; 
?>