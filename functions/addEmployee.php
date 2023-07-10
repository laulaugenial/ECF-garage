<?php

$db = new PDO('pgsql:host=localhost;port=5432;dbname=ECF', 'laulaugenial', 'root');

if(isset($_POST['ajouter'])) {
    if(!empty($_POST['name']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $name = htmlspecialchars($_POST['name']);
        $password = sha1($_POST['password']);
        $insertUser = $db->prepare('INSERT INTO users(email, password, name, lastname) VALUES(?, ?, ?, ?)');
        $insertUser->execute(array($email, $password, $name, $lastname));
    } else {
        echo "Veuillez compléter les champs";
    }
}
header ("location: ../admin/home.php");

?>