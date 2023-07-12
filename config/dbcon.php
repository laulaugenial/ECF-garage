<?php
try
{
        $db = new PDO('pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'laulaugenial', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES   => false]);
}
catch (PDOException $PDOException)
{
        echo'Impossible de se connecter à la BDD';
}
?>

