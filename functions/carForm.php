<?php
try {
    $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

    // Récupérer les données du formulaire des renseignements voiture
    
    $prenom = htmlspecialchars($_POST['name']);
    $nom = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $car = $_POST['chosen'];
    $message = htmlspecialchars($_POST['message']);
    

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
