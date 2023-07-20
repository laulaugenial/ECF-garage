<?php

session_start();

// Vérifie si l'utilisateur est authentifié
function isUserAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Redirige l'utilisateur vers la page de login s'il n'est pas authentifié
function redirectToLogin() {
    header('Location: ../admin/login.php');
    exit();
}

// Authentifie l'utilisateur (à appeler lorsqu'il se connecte)
function authenticateUser($userId) {
    $_SESSION['user_id'] = $userId;
}

// Déconnecte l'utilisateur (à appeler lorsqu'il se déconnecte)
function logoutUser() {
    session_unset();
    session_destroy();
    redirectToLogin();
}
if (isset($_POST['logout'])) {
    logoutUser();
  }
?>