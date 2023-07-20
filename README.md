# Fichier Readme de l'ECF hiver 2023

Bonjour et bienvenue dans mon projet d'ECF !

Il a été réalisé en HTML, CSS, JavaScript et PHP.
Pour une exécution en local il vous faudra donc installer un serveur local comme XAMPP.

Depuis votre terminal, entrez la commande suivante : 
git clone https://github.com/laulaugenial/ECF-garage.git

Pour vous connecter à la base de données, vous pouvez vous rendre dans le dossier "config", ouvrez
le fichier "dbcon.php" et modifiez la valeur du PDO par :
pgsql:host=localhost;dbname=ECF;port=5432;options=\'--client_encoding=UTF8\'', 'root', 'root'
Vous pouvez changer l'identifiant et le mot de passe si vous le souhaitez

Ouvrez Postgresql, cliquez sur requêtes SQL puis entrez CREATE DATABASE ECF;
Cliquez sur "importer" pour importer le fichier sql-ECF.sql


Pour se connecter au backoffice, il suffit d'accéder à la page login  dans le footer et de cliquer
sur le lien "Espace Pro"

Identifiants

Connexion à l'espace Admin :
adresse mail : v.parrot@gmail.com
mdp : BonjourVous4893

Connexion à l'espace Employé : 
adresse mail : martine@gmail.com
mdp : Coucoulamif