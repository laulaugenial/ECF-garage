<?php
try {
    $db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

    // Récupérer les données du formulaire des renseignements voiture
    
    $prenom = $_POST['name'];
    $nom = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $car = $_POST['chosen'];
    $message = $_POST['message'];
    

    // Insérer le commentaire dans la base de données
    $query = "INSERT INTO carForm (name, lastname, mail, phone, car, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$prenom, $nom, $email, $phone, $car, $message]);

    echo "Votre message a été envoyé avec succès !";
    header("location: ../vehicules.php");
} catch (PDOException $e) {
    echo "Une erreur s'est produite lors de l'envoi de votre message : " . $e->getMessage();
}
?>
