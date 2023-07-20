<?php
session_start();
include_once('../config/dbcon.php');
  
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();

if ($user && (password_verify($_POST['password'], $user['password'])))
{
    if (($user['user_type'] === 'Admin'))
    {   
        session_start();
        $_SESSION['name'] = $user['name'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: ../admin/home.php');
        exit();
    }
    else
    {
        if($user['user_type'] == 'Employee')
        {   
            session_start();
            $_SESSION['name'] = $user['name'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['user_id'] = $user['user_id'];
            header('Location: ../admin/employee.php');
            exit();
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