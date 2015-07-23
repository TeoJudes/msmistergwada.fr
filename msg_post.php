<?php
function verifMail ($mail) 
{
	if (preg_match ('/^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]/i', $mail ) ) {
		return false;
	}
	list ($nom, $domaine) = explode ('@', $mail);
	if (getmxrr ($domaine, $mxhosts))  {
		return true;
	} else {
		return false;
	} 
} 
function verifEmail ($expediteur) {
    if (filter_var ($expediteur, FILTER_VALIDATE_EMAIL) === false) {
        return false;
    } else {
        return true;
    }
}
$destinataire = 'contact@msmistergwada.fr';
$expediteur = $_POST['email'];
$objet = $_POST['objet'];     
$message = $_POST['message'];
$headers = "From:" . $expediteur  . "\r\n";
if (mail($destinataire, $objet, $message, $headers))
{
	 header('Location: http://www.msmistergwada.fr');
	 exit;
}
else // Non envoyé
{
    header('Location: erreur.html');
    exit;
}
?>