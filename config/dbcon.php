<?php
try
{
        $db = new PDO('pgsql:host=localhost;port=5432;dbname=ECF', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $PDOException)
{
        echo'Impossible de se connecter à la BDD';
}
?>

