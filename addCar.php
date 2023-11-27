<?php
include_once('../config/dbcon.php');

if(isset($_POST['ajouter'])) {
    if(!empty($_POST['carbrand']) && !empty($_POST['price'])) {
        $carbrand = htmlspecialchars($_POST['carbrand'], ENT_QUOTES, 'UTF-8');
        $year = htmlspecialchars($_POST['year'], ENT_QUOTES, 'UTF-8');
        $fuel = htmlspecialchars($_POST['fuel'], ENT_QUOTES, 'UTF-8');
        $km = htmlspecialchars($_POST['km'], ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');
        $infos = htmlspecialchars($_POST['infos'], ENT_QUOTES, 'UTF-8');

        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $imageFileName = basename($_FILES['image']['name']);
            $targetDir = '../ECF-garage/uploads/';

            // Vérifie type fichier
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = strtolower(pathinfo($imageFileName, PATHINFO_EXTENSION));

            if (in_array($fileExtension, $allowedExtensions)) {

                // Renomme le fichier
                $newFileName = md5(uniqid()) . '.' . $fileExtension;
                $targetFile = $targetDir . $newFileName;

                // Vérifie taille fichier
                $maxFileSize = 2 * 1024 * 1024;
                if ($_FILES['image']['size'] <= $maxFileSize) {

                // Vérification MIME
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $fileMimeType = finfo_file($finfo, $_FILES['image']['tmp_name']);
                finfo_close($finfo);

                // Déplacer l'image téléchargée vers le répertoire des images
                move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            } else {
                echo "Erreur : la taille du fichier est trop grande.";
                exit();
            }
        } else {
            echo "Erreur : type de fichier non autorisé.";
            exit();
        }
    } else {
        echo "Erreur : aucun fichier n'a été téléchargé.";
        exit();
    }

        try{
            $query = "INSERT INTO car (carbrand, year, fuel, km, price, infos, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$marque, $annee, $typeEssence, $kilometrage, $prix, $image]);

            echo "Le véhicule a été ajouté avec succès !";
        } catch (PDOException $e) {
            echo "Une erreur s'est produite lors de l'ajout du véhicule.";
        }
    } else {
        echo "Erreur : Les champs obligatoires ne sont pas remplis.";
    }
}
?>


