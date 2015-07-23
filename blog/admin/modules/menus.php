<?php

/* Affiche la liste des menus (Administration) */

function menuslisteadmin() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM menus');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Titre</center></th><th class="visible-desktop"><center>Lien</center></th><th><center>Supprimer</center></th><th><center>Editer</center></th></tr></thead>';

while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td style="text-align:center";>';
echo $donnees['titre'];
echo'</td>
<td class="visible-desktop" style="text-align:center;">';
echo $donnees['lien'];
echo'</td>';
echo'<td><center><a href="index.php?page=supprimermenus&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td><td><center><a href="index.php?page=editermenus&id='.$donnees['ID'].'"><img src="images/edition.png" alt="Editer" width="16px"></a></center></td></tr></thead>';
}

echo'</table>';
echo'<a href="index.php?page=ajoutermenus" title="Ecrire Liens" style="text-align:center;text-decoration:none;"><i><img src="images/ecrire.png"></i> Partager un nouveau menu</a>';
} 

/* Sert à partager un nouveau lien */

function ajout_menus() {

include('../db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM menus');

if( isset($_POST['titre']) && isset($_POST['lien']) ) {

$titre = htmlentities($_POST['titre'],null,'UTF-8');
$lien = htmlentities($_POST['lien'],null,'UTF-8');

$req = $bdd->prepare('INSERT INTO menus(titre, lien) VALUES(:titre, :lien)');

$req->execute(array(
	'titre' => $titre,
	'lien' => $lien
));
	header('Location: index.php?page=listemenus&messages=creerok');
}
else {
echo'<form action="" method="post">
<label for="titre" class="input-group-addon">Titre</label> <input type="text" required name="titre" id="titre" class="form-control" placeholder="Votre titre de menu" />
<br /><label for="lien" class="input-group-addon"> Lien</label><input type="text" required name="lien" id="lien" rows="" cols="" placeholder="Votre lien de menu" class="form-control" /><br />';

echo'<center><input type="submit" value="Ok" /></center></form>';
}
}

/* Sert à éditer un lien existant */

function editer_menus() {

include('../db.php');

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM menus WHERE ID = '.$id.' '); 

if(!isset($_GET['id'])) {
	header('Location: index.php?page=listemenus');
	exit();
}

if( isset($_POST['titre']) && isset($_POST['lien'])) {

$titre = htmlentities($_POST['titre'],null,'UTF-8');
$lien = htmlentities($_POST['lien'],null,'UTF-8');
$id = (int) $_GET['id'];

$req = $bdd->prepare('UPDATE menus SET titre = :titre, lien = :lien WHERE ID= :id');

$req->execute(array(
	'titre' => $titre,
	'lien' => $lien,
	'id' => $id
));

header('Location: index.php?page=listemenus&messages=editerok');

} else {

while ($donnees = $reponse->fetch())
{

	echo'<form action="" method="POST">
<label for="titre" class="input-group-addon">Titre</label> <input  class="form-control" type="text" required name="titre" id="titre"  placeholder="Titre de votre menu" value="'.$donnees['titre'].'" /> <br />
<label for="lien" class="input-group-addon">Lien</label><input  class="form-control" type="text" required placeholder="Lien de votre menu" name="lien" id="lien" rows="" cols="" value="'.$donnees['lien'].'"/><br />';

echo'
<center><input type="submit" value="Ok" /></center>
	</form>';
	
}}
}


/* Sert à supprimer un lien */

function supprimer_menus() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM menus');

if(!isset($_GET['id'])) {

	header('Location: index.php?page=listemenus');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `menus` WHERE `menus`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

header('Location: index.php?page=listemenus&messages=supprimerok');

}

?>
