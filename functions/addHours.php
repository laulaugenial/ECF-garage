<?php
$db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);

if(isset($_POST['addHours'])) {
    if(!empty($_POST['day']) AND !empty($_POST['hours'])) {
        $day = $_POST['day'];
        $hours = $_POST['hours'];
        $insertHours = $db->prepare("UPDATE openingHours SET hours = ? WHERE day = ?");
        $insertHours->execute([$hours, $day]);
    } else {
        echo "Veuillez compléter les champs";
    }
    header("location : ../admin/home.php");
}

?>