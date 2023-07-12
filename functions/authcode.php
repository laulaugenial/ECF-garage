<?php
session_start();
include_once('../config/dbcon.php');
  
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();

if ($user && ($_POST['password'] == $user['password']))
{
    echo "valid!";
    header('Location: ../admin/home.php');
} else {
    echo "invalid";
}
 
?>