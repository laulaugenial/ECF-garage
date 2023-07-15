<?php
session_start();
include_once('../config/dbcon.php');
  
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();

if ($user && ($_POST['password'] == $user['password']))
{
    if (($user['user_type'] == 'Admin'))
    {
        header('Location: ../admin/home.php');
    }
    else
    {
        if($user['user_type'] == 'Employee')
        {
            header('Location: ../admin/employee.php');
        }
        else 
        {
            header('Location: ../admin/login.php');
            echo "pb de connexion";
        }
    }
   
} else {
    header('Location: ../admin/login.php');
    echo "Erreur de connexion";
}

?>