<?php
include('../config/dbcon.php');

if(isset($_POST['ajouter'])) {
    if(!empty($_POST['name']) AND !empty($_POST['lastname']) AND !empty($_POST['email']) AND !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $name = htmlspecialchars($_POST['name']);
        $password = $_POST['password'];
        $insertUser = $db->prepare('INSERT INTO users(email, password, name, lastname, user_type) VALUES(?, ?, ?, ?, ?)');
        $insertUser->execute(array($email, $password, $name, $lastname, 'Employee'));
    } else {
        echo "Veuillez compléter les champs";
    }
}
echo "Compte Employé ajouté";
header ("location: ../admin/home.php");




?>