<?php

try
{
    // On se connecte à MySQL

//$bdd = new PDO('sqlite:inu');

if(!defined("SQL_SERVER"))
{

define('SQL_SERVER','msmistergwada.fr.mysql');
}

if(!defined("SQL_USER"))
{

define('SQL_USER','msmistergwada_f');
}

if(!defined("SQL_PASS"))
{

define('SQL_PASS','liaze69');
}

if(!defined("SQL_BDD"))
{

define('SQL_BDD','msmistergwada_f');
}

$bdd = new PDO('mysql:host=msmistergwada.fr.mysql;dbname=msmistergwada_f', 'msmistergwada_f', 'liaze69');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur lors de la connexion à la BDD (vérifier le fichier mysql)');
}

?>

