<?php

//Affiche le titre de la page du formulaire de contact.

function tcontact()   {

include('db.php');

$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1 ');

while ($donnees2 = $reponsec->fetch())
{

echo'<title>'.$donnees2['titre'].' - Contact</title>';

}
}

//Affiche les messages du formulaire de contact dans l'administration.

function liste_contact() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM contact WHERE destinataire= '.$_SESSION['pseudo'].' ');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Destinataire</center></th><th><center>Message</center></th><th class="visible-desktop"><center>Email</center></th><th class="visible-desktop"><center>Titre</center></th><th><center>Supprimer</center></th></tr></thead>';
 
while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td>';
$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['destinataire'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo ''.$donneesd['prenoms'].' '.$donneesd['nom'].'';
} 
echo'</td>
<td>';
echo $donnees['contenu'];
echo'</td>
<td class="visible-desktop">';
echo $donnees['email'];
echo'</td><td class="visible-desktop"><center>';
echo $donnees['titre'];
echo'</center></td><td><center><a href="index.php?page=supprimerc&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td></tr></thead>';

}
echo'</table>';
} 

//Ajouter un des messages dans le formulaire de contact

function ajout_contact() {

include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM contact');

	if ( isset($_POST['titre']) && isset($_POST['email']) && isset($_POST['contenu']) && isset($_POST['destinataire']) ) {
	 
	$titre = htmlentities($_POST['titre'],null,'UTF-8');
	$contenu = htmlentities($_POST['contenu'],ENT_QUOTES,'UTF-8');
	$email = htmlentities($_POST['email'],null,'UTF-8');
	$destinataire = htmlentities($_POST['destinataire'],null,'UTF-8');
	
$req = $bdd->prepare('INSERT INTO contact(titre, contenu, email, destinataire) VALUES(:titre, :contenu, :email, :destinataire)');

$req->execute(array(
	'titre' => $titre,
	'contenu' => $contenu,
	'email' => $email,
	'destinataire' => $destinataire,

));
	
	header('Location: index.php?module=contact');

	} else {
	 
	echo'

	<form action="" method="post">
	
	<div class="input-group" style="width: 98%;"/>
	<span class="input-group-addon" style="width: 10%; padding: 4px 0px;">Titre</span>
	<input class="form-control" type="text" required name="titre" id="titre" placeholder="Un titre pour accompagner votre court ou long message."/>
    </div><br />
	
	<div class="input-group" style="width: 98%;"/>
	<span class="input-group-addon" style="width: 10%; padding: 4px 0px;">Email</span>
	<input class="form-control" type="email" required name="email" id="email" rows="" cols="" placeholder="Votre email, si vous souhaitez recevoir une réponse."/>
	</div><br />
	
	<div class="input-group" style="width: 98%;"/>
	<span class="input-group-addon" style="width: 10%; padding: 4px 0px;">Destinataire</span>
<select class="form-control" id="destinataire" name="destinataire">';

include('db.php');

$reponse2 = $bdd->query('SELECT * FROM utilisateurs'); 

while ($donnees2 = $reponse2->fetch())
 {

echo'<option value="'.$donnees2['ID'].'">'; echo $donnees2['prenoms']; echo' '; echo $donnees2['nom']; echo'</option>';

 };
 
echo'</select></div>

<br/><textarea class="form-control" name="contenu" required id="contenu" rows="" placeholder="Votre message : suggestions, remarques ou autre." cols="" style="width: 98%;height: 200px;"></textarea><br />';

	echo'<center><input  class="btn" type="submit" value="Ok" /></center></form>';
	
	}
	echo'
            
          </div></div></div>';
	}

//Supprimer un des messages du formulaire de contact.

function supprimer_contact() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM contact');

if(!isset($_GET['id'])) {

	header('Location: index.php?page=listec');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `contact` WHERE `contact`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

header('Location: index.php?page=listec&messages=supprimerok');

}

?>
