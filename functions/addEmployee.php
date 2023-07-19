<?php
try {
    $db = new PDO('pgsql:host=postgresql-ecf-garage.alwaysdata.net;dbname=ecf-garage_ecf;port=5432;options=\'--client_encoding=UTF8\'', 'ecf-garage_laulaugenial', 'iKG*!ZhGtg6gah*', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);


    if(isset($_POST['ajouter'])) {
        if(!empty($_POST['name']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $name = htmlspecialchars($_POST['name']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
            $insertUser = $db->prepare('INSERT INTO users(email, password, name, lastname, user_type) VALUES(?, ?, ?, ?, ?)');
            $insertUser->execute(array($email, $password, $name, $lastname, 'Employee'));
        } else {
            echo "Veuillez compléter les champs";
        }
    }
    echo "Compte Employé ajouté";
    header ("location: ../admin/home.php");

} catch (PDOException $e) {
    echo "Une erreur s'est produite lors de l'enregistrement d'un nouveau compte employé " . $e->getMessage();
}
?>