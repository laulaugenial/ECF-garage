<?php
try {
    $db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

    // Récupérer les données du formulaire des avis
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $note = $_POST['note'];

    // Insérer le commentaire dans la base de données
    $query = "INSERT INTO avis (prenom, nom, email, message, note) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$prenom, $nom, $email, $message, $note]);

    echo "Votre commentaire a été enregistré avec succès !";
    header("location: ../index.php");
} catch (PDOException $e) {
    echo "Une erreur s'est produite lors de l'enregistrement du commentaire : " . $e->getMessage();
}
?>