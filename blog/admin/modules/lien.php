<?php

/* Affiche le titre d'un lien */

function tliens()  {

include('db.php');

if (isset($_GET['id'])){ 

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM liens WHERE ID = '.$id.' ');
$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1 ');

while ($donnees = $reponse->fetch())
{
while ($donnees2 = $reponsec->fetch())
{
echo'<title>'.$donnees2['titre'].' - '.$donnees['titre'].'</title><meta name="Description" content="'.$donnees['chapo'].'">';	
}
}
}

}

/* Affiche le contenu d'un lien*/

function liens()  {

include('db.php');

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM liens WHERE ID = '.$id.' '); 

if(!isset($_GET['id'])) {
	header('Location: index.php?module=listearticles');
	exit();
}


while ($donnees = $reponse->fetch())
{

echo'

<div class="input-prepend" style="width: 99%;">
<span class="add-on" style="width: 25%; padding: 4px 0px;">Partageur : </span><span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">';

$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo '<a href="index.php?module=utilisateurs&id='.$donnees['auteur'].'">'.$donneesd['prenoms'].' '.$donneesd['nom'].'</a>';
} 

echo'</span> - 
<span class="add-on" style="width: 25%; padding: 4px 0px;">Lien : </span><span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;"><a href="'.$donnees['lien'].'">'.$donnees['titre'].'</a></span> - 
<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['jour'].'</span>
/<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['mois'].'</span>
/<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['annee'].'</span><br /><br />
<div style="

display: inline-block;
  margin-top: -10px;
  font-size: 0;
  vertical-align: middle;
  
width: 97.5%;
background-color: rgb(255, 255, 255);
border: 1px solid rgb(212, 212, 212);
font-size: 110%;padding-left:10px;padding-top:10px;padding-bottom:10px;padding-right:10px;">'.$donnees['chapo'].'</div><br /><br />

</div>';

}	
}

/* Affiche la liste des liens */

function liensliste() {

include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM liens');

echo'<';

while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td style="text-align:center;"><a href="index.php?module=liens&id='.$donnees['ID'].'");">';
echo $donnees['titre'];
echo'</a></td>
<td style="text-align:center;">';
echo' '.$donnees['jour'].'/'.$donnees['mois'].'/'.$donnees['annee'].' ';
echo'</td>
<td style="text-align:center;">';
$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo '<a href="index.php?module=utilisateurs&id='.$donnees['auteur'].'">'.$donneesd['prenoms'].' '.$donneesd['nom'].'</a>';
} 
echo'</td></tr></thead>';
}

echo'</table>';
}

/* Affiche la liste des liens (Administration) */

function lienslisteadmin() {

include('../db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM liens WHERE auteur= '.$_SESSION['pseudo'].' ');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Titre</center></th><th class="visible-desktop"><center>Date</center></th><th class="visible-desktop"><center>Auteur</center></th><th><center>Supprimer</center></th><th><center>Editer</center></th></tr></thead>';

while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td style="text-align:center";>';
echo $donnees['titre'];
echo'</td>
<td class="visible-desktop" style="text-align:center;">';
echo' '.$donnees['jour'].' / '.$donnees['mois'].' / '.$donnees['annee'].' ';
echo'</td>
<td class="visible-desktop"><center>';
$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo ''.$donneesd['prenoms'].' '.$donneesd['nom'].'';
} 
echo'</center></td><td><center><a href="index.php?page=supprimerliens&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td><td><center><a href="index.php?page=editerliens&id='.$donnees['ID'].'"><img src="images/edition.png" alt="Editer" width="16px"></a></center></td></tr></thead>';

} 

echo'</table>';
echo'<a href="index.php?page=ajouterliens" title="EcrireLiens" style="text-align:center;text-decoration:none;"><i><img src="images/ecrire.png"></i> Partager un nouveau lien</a>';
} 

/* Sert à partager un nouveau lien */

function get_file_title($file){
$cont = file_get_contents($file);
preg_match( "/<title>(.*)<\/title>/i", $cont, $match );
return strip_tags($match[0]);}

function ajout_liens() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM liens');

if(isset($_POST['lien']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee']) && isset($_POST['chapo']) && isset($_POST['auteur']) ) {

$auteur = htmlentities($_POST['auteur'],null,'UTF-8');
$lien = htmlentities($_POST['lien'],null,'UTF-8');
$chapo = htmlentities($_POST['chapo'],null,'UTF-8');
$jour = htmlentities($_POST['jour'],null,'UTF-8');
$mois = htmlentities($_POST['mois'],null,'UTF-8');
$annee = htmlentities($_POST['annee'],null,'UTF-8');
$titre = get_file_title($lien);
     
$req = $bdd->prepare('INSERT INTO liens(auteur, lien, chapo, jour, mois, annee, titre) VALUES(:auteur, :lien, :chapo, :jour, :mois, :annee, :titre)');

$req->execute(array(
	'auteur' => $auteur,
	'lien' => $lien,
	'chapo' => $chapo,
	'jour' => $jour,
	'mois' => $mois,
	'annee' => $annee,
	'titre' => $titre

));
	
header('Location: index.php?page=listeliens&messages=creerok');

}
else {
echo'<form action="" method="post">
<label for="titre" class="input-group-addon">Auteur</label> 
<select class="form-control" id="auteur" name="auteur">';

$reponse2 = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$_SESSION['pseudo'].' '); 

while ($donnees2 = $reponse2->fetch())
 {

echo'<option value="'.$donnees2['ID'].'">'; echo $donnees2['prenoms']; echo' '; echo $donnees2['nom']; echo'</option>';

 };
 
echo'</select><br/>
<label for="jour" class="input-group-addon" >'.Jour.'</label><SELECT name="jour" class="form-control" id="jour">

<OPTION>'.(date('d')+0).'</OPTION>
';  


echo'</SELECT><br/>

<label for="mois" class="input-group-addon">'.Mois.'</label><SELECT name="mois" id="mois" class="form-control">
<OPTION>'.(date('m')+0).'</OPTION>
';
 
echo'</SELECT><br/>

<label for="annee" class="input-group-addon">'.Annee.'</label><SELECT name="annee" id="annee" class="form-control">
<OPTION>'.(date('Y')+0).'</OPTION>
</SELECT>

<br />
<label for="lien" class="input-group-addon">Lien</label> <input type="text" required name="lien" id="lien" class="form-control" placeholder="Le lien que vous souhaitez partager" />
<br /><label for="chapo" class="input-group-addon">Avis</label><input type="text" required name="chapo" id="chapo" rows="" cols="" placeholder="Votre avis sur le contenu du lien que vous allez partager." class="form-control" /><br />';

echo'<center><input type="submit" value="Ok" /></center></form>';
}
}

/* Sert à éditer un lien existant */

function editer_liens() {

include('../db.php');

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM liens WHERE ID = '.$id.' ');    

if(!isset($_GET['id'])) {
	header('Location: index.php?page=listeliens');
	exit();
}


if(isset($_POST['titre']) && isset($_POST['chapo'])) {
$lien = htmlentities($_POST['lien'],null,'UTF-8');
$chapo = htmlentities($_POST['chapo'],null,'UTF-8');
$jour = htmlentities($_POST['jour'],null,'UTF-8');
$mois = htmlentities($_POST['mois'],null,'UTF-8');
$annee = htmlentities($_POST['annee'],null,'UTF-8');
$titre = htmlentities($_POST['titre'],null,'UTF-8');
$id = (int) $_GET['id'];


$req = $bdd->prepare('UPDATE liens SET lien = :lien, chapo = :chapo, jour = :jour, mois = :mois, annee = :annee, titre = :titre WHERE ID= :id');

$req->execute(array(
	'auteur' => $auteur,
	'lien' => $lien,
	'chapo' => $chapo,
	'jour' => $jour,
	'mois' => $mois,
	'annee' => $annee,
	'titre' => $titre,
	'id' => $id
));

header('Location: index.php?page=listeliens&messages=editerok');

} else {

while ($donnees = $reponse->fetch())
{
	echo'<form action="" method="POST">
<label for="auteur" class="input-group-addon">Auteur</label> 
<input readonly="true" class="form-control" type="text" value="';

$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo ''.$donneesd['prenoms'].' '.$donneesd['nom'].'';
} 

echo'" />
<br />
<label for="titre" class="input-group-addon">Titre</label> <input  class="form-control" type="text" required name="titre" id="titre" value="'.$donnees['titre'].'" /> <br />
<label for="jour" class="input-group-addon">Jour</label> <input  class="form-control" type="text" name="jour" id="jour" value="'.$donnees['jour'].'" readonly="readonly"/ > <br />
<label for="mois" class="input-group-addon">Mois</label> <input  class="form-control" type="text" name="mois" id="mois" value="'.$donnees['mois'].'" readonly="readonly" /> <br />
<label for="annee" class="input-group-addon">Annee</label> <input  class="form-control" type="text" name="annee" id="annee" value="'.$donnees['annee'].'" readonly="readonly" /> 
<br /><label for="lien" class="input-group-addon">Lien : </label><input  class="form-control" type="text" required name="lien" id="lien" rows="" cols="" value="'.$donnees['lien'].'"/>
<br /><label for="chapo" class="input-group-addon">Chapo : </label><input  class="form-control" type="text" required name="chapo" id="chapo" rows="" cols="" value="'.$donnees['chapo'].'"/><br />';
}

echo'
<center><input type="submit" value="Ok" /></center>
	</form>';
	
}
}

/* Sert à supprimer un lien */

function supprimer_liens() {

include('../db.php');

// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM liens');


if(!isset($_GET['id'])) {

	header('Location: index.php?page=listeliens');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `liens` WHERE `liens`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

header('Location: index.php?page=listeliens&messages=supprimerok');;

}

?>
