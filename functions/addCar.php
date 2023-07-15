<?php
include_once('../config/dbcon.php');

if(isset($_POST['ajouter'])) {
    if(!empty($_POST['carbrand']) AND !empty($_POST['price'])) {
        $carbrand = $_POST['carbrand'];
        $year = $_POST['year'];
        $fuel = $_POST['fuel'];
        $km = $_POST['km'];
        $price = $_POST['price'];
        $infos = $_POST['infos'];
        $insertInfos = $db->prepare('INSERT INTO car(carbrand, year, fuel, km, price, infos) VALUES (?, ?, ?, ?, ?, ?)');
        $insertInfos->execute(array($carbrand, $year, $fuel, $km, $price, $infos));

        if($insertInfos) {echo "Voiture enregistrée";};

    } else {
        echo "Veuillez compléter les champs";
    }
}


header ("location: ../admin/employee.php");




?>