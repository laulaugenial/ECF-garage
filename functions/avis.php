<?php
include_once('../config/dbcon.php');

if(isset($_POST['btnAvis'])) {
    if(!empty($_POST['nameComment']) AND !empty($_POST['lastnameComment']) AND !empty($_POST['emailComment']) AND !empty($_POST['gradeComment']) AND !empty($_POST['comment'])) {
        $nameComment = $_POST['nameComment'];
        $lastnameComment = $_POST['lastnameComment'];
        $emailComment = $_POST['emailComment'];
        $gradeComment = $_POST['gradeComment'];
        $comment = $_POST['comment'];
        $insertComment = $db->prepare('INSERT INTO comments(firstname, lastname, mail, grade, message) VALUES (?, ?, ?, ?, ?)');
        $insertInfos->execute(array($nameComment, $lastnameComment, $emailComment, $gradeComment, $comment));
    } else {
        echo "Veuillez compléter les champs";
    }
}
echo "Commentaire envoyé !";
header ("location: ../index.php");



