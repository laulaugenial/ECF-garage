<?php
session_start();
include_once('../config/dbcon.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();
     
    foreach($users as $user) {
         
        if(($user['email'] == $email) &&
            ($user['password'] == $password)) {
                header("location: ../admin/home.php");
        }
        else {
            echo "<script language='javascript'>";
            echo "alert('Informations non valides')";
            echo "</script>";
            header("location: ../admin/login.php");
            die();
        }
    }
}
 
?>