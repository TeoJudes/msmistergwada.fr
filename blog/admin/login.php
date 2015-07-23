<?php
session_start();
//// Cap_private_zone v1.0 15/05/2004 ////

include('../db.php');

/// CONFIGURATION DE LA BASE DE DONNEE ET DE LA REDIRECTION

$private_zone = 'index.php' ;

$db_link = @mysql_connect(SQL_SERVER,SQL_USER,SQL_PASS);
mysql_select_db(SQL_BDD);

$salt = 'BwGk15l8WX'; 
$login = $_POST['login'] ;
$code_crypt = sha1($_POST['code'].$salt);

if(isset($_GET['ajout']) and strlen($_GET['ajout']) and is_numeric($_GET['ajout'])) {
	if(isset($_POST['login']) and isset($_POST['code'])) {
		$sql = "insert into cap_private_zone (login,code) values ('".$login."','".$code_crypt."')";
		mysql_query($sql);
		header("location: ".$private_zone);
	}
	else {
		die('<b>Erreur</b>');
	}
}

if(isset($_GET['logout']) and strlen($_GET['logout']) and is_numeric($_GET['logout'])) {
	$_SESSION['log'] = 0 ;
	header("location: connexion.php");
}

$sql = 'select count(*) from utilisateurs where id = "'.mysql_escape_string($login).'" and code = "'.$code_crypt.'" LIMIT 1' ;
$rc = mysql_query($sql);

if(mysql_result($rc,0) == '0') {
	die('<b>Erreur</b><br><br>Login/code Incorrect<br><br><a href="connexion.php">Retour</a>');
}

$_SESSION['log'] = 1 ;
$_SESSION['pseudo'] = $login ;

header("location: ".$private_zone);

//// Capoune.net ////
?>
