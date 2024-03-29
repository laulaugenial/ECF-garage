<?php

if(isset($_POST['ajouter'])) {
    if(!empty($_POST['carbrand']) AND !empty($_POST['price'])) {
        $carbrand = htmlspecialchars($_POST['carbrand']);
        $year = htmlspecialchars($_POST['year']);
        $fuel = htmlspecialchars($_POST['fuel']);
        $km = htmlspecialchars($_POST['km']);
        $price = htmlspecialchars($_POST['price']);
        $infos = htmlspecialchars($_POST['infos']);

        if (isset($_FILES['image']) || $_FILES['image']['error'] === 0) {
            $image = $_FILES['image']['name'];
            $targetDir = '../ECF-garage/uploads/';
            $targetFile = $targetDir . basename($image);

             // Déplacer l'image téléchargée vers le répertoire des images
             move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
        }

        try {
            $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

            // Insérer les données dans la base de données
            $query = "INSERT INTO car (carbrand, year, fuel, km, price, infos, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$marque, $annee, $typeEssence, $kilometrage, $prix, $image]);

            echo "Le véhicule a été ajouté avec succès !";
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de l'ajout du véhicule : " . $e->getMessage();
        }
    }
}

?>


