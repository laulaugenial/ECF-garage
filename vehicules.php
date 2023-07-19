<section class="header">
  <?php 
    require_once __DIR__.'/templates/header.php';

  ?> 

</section>

<script>
$(document).ready(function(){
  $("#marque").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    $(".sales-col").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  $("#prix-min").on("keyup", function() {
  var minPrice = parseFloat($(this).val());

  $(".sales-col").filter(function() {
    return parseFloat($(this).find(".prix").text()) >= minPrice;
  }).show();

  $(".sales-col").filter(function() {
    return parseFloat($(this).find(".prix").text()) < minPrice;
  }).hide();
});
//  $("#prix-min").on("keyup", function() {
//    var minPrice = parseFloat($(this).val());

  //  $(".sales-col").filter(function() {
    //  $(this).toggle(parseFloat($(this).find(".prix").text()) >= minPrice);
 // });
//});
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
      <input type="number" id="prix-min" name="prix-min">
      <label for="prix-max">Prix maximum :</label>
      <input type="number" id="prix-max" name="prix-max">
  </form>
</div>

  <div class="row-sales">

    <?php
      $db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);
      $req=$db->query("SELECT * FROM car ORDER BY car_id DESC");

      while($aff=$req->fetch()) {

        echo '<div id="carte" class="sales-col">';
          $imagePath = '../ECF-garage/uploads/' . $aff['image'];
        echo '<img src="' . $imagePath . '" alt="Image de la voiture à vendre">';
        echo '<h3 class="brand">' . $aff['carbrand'] . '</h3>';
        echo '<p>Année :' . $aff['year'] . '</p>';
        echo '<p>' . $aff['fuel'] . '</p>';
        echo '<p class="kilometrage">' . $aff['km'] . 'km</p>';
        echo '<h4 classe="prix">' . $aff['price'] . '€</h4>';
        echo '<p>' . $aff['infos'] . '</p>';
        echo '<div class="additional-info">';
        echo '<p>' . $aff['infos'] . '</p>';
        echo '</div>';
        echo '<button class="show-more-btn">Afficher plus</button>';
        echo '</div>';
      }
      
      ?>
  </div>
</section>

<section class="sales-articles">
  <div class="car-filter">
    <div class="modify-col">
      <h2>Une question sur une voiture en particulier ?</h2>
      <form class="modify-form" action="../ECF-garage/functions/carForm.php" method="POST">
            
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