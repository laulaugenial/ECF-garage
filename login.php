<?php

// VALIDATION FORMULAIRE
if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            $loggedUser = [
                'email' => $user['email'],
            ];
        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
?>


<!-- UNIDENTIFIED USER -->

<?php if(!isset($loggedUSer)): ?>
<form action = "home.php" method = "post">


    <!-- ERROR MESSAGE-->

    <?php if(isset($errorMessage)) : ?>
        <div class = "alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
        <form class="comment-form">
            <label for=" email">Email :</label>
            <input type="email" placeholder="Entrez votre email">
            <label for="pass">Mot de passe :</label>
            <input type="password" id="pass" name="password" minlength="8" required>
            <button type="submit" class="hero-btn red-btn">Se connecter</button>
        </form>


<!-- CONNEXION SUCCESS -->

<?php else: ?>
    <div class="success">
        Bienvenue sur l'espace pro du garage !
    </div>
<?php endif; ?>