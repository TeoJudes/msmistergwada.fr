<?php

function userslisteadmin() {

include('../db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM utilisateurs');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Prenoms</center></th><th class="visible-desktop"><center>Nom</center></th><th class="visible-desktop"><center>Pays</center></th><th class="visible-desktop"><center>ID</center></th><th><center>Supprimer</center></th><th><center>Editer</center></th></tr></thead>';

while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td style="text-align:center";>';
echo $donnees['prenoms'];
echo'</td>
<td style="text-align:center;">';
echo $donnees['nom'];
echo'</td>
<td style="text-align:center;">';
echo $donnees['pays'];
echo'</td>
<td style="text-align:center;">';
echo $donnees['ID'];
echo'</td><td><center><a href="index.php?page=supprimerutilisateurs&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td><td><center><a href="index.php?page=editerutilisateurs&id='.$donnees['ID'].'"><img src="images/edition.png" alt="Editer" width="16px"></a></center></td></tr></thead>';
}
echo'</table>';
echo'<a href="index.php?page=ajouterutilisateurs" title="EcrireUtilisateurs" style="text-align:center;text-decoration:none;"><i><img src="images/ecrire.png"></i> Ajouter un utilisateur</a>';
} 

/* Sert à partager un nouveau lien */

function ajout_users() {

include('../db.php');

$salt = 'BwGk15l8WX'; 

$reponse = $bdd->query('SELECT * FROM utilisateurs');

if( isset($_POST['prenoms']) && isset($_POST['nom'])) {

$prenoms = htmlentities($_POST['prenoms'],null,'UTF-8');
$nom = htmlentities($_POST['nom'],null,'UTF-8');
$pays = htmlentities($_POST['pays'],null,'UTF-8');
$photo = htmlentities($_POST['photo'],null,'UTF-8');
$activite = htmlentities($_POST['activite'],null,'UTF-8');
$biographie = htmlentities($_POST['biographie'],null,'UTF-8');
$loisirs = htmlentities($_POST['loisirs'],null,'UTF-8');
$code = sha1($_POST['code'].$salt);

$req = $bdd->prepare('INSERT INTO utilisateurs(prenoms, nom, pays, photo, activite, biographie, loisirs, code) VALUES(:prenoms, :nom, :pays, :photo, :activite, :biographie, :loisirs, :code)');

$req->execute(array(
	'prenoms' => $prenoms,
	'nom' => $nom,
	'pays' => $pays,
	'photo' => $photo,
	'activite' => $activite,
	'biographie' => $biographie,
	'loisirs' => $loisirs,
	'code' => $code
));

header('Location: index.php?page=listeutilisateurs&messages=creerok');
	
}
else {
	 echo'<form action="" method="post">
<label for="prenoms" class="input-group-addon">Prenoms</label><input class="form-control" type="text" required name="prenoms" id="prenoms" rows="" cols="" placeholder="Veuillez mettre vos prenoms."/><br />

<label for="noms" class="input-group-addon">Nom</label><input class="form-control" type="text" required name="nom" id="nom" rows="" cols="" placeholder="Veuillez mettre votre nom." /><br />
<label for="pays" class="input-group-addon">Pays</label><SELECT id="pays" class="form-control" name="pays" >';

$world = array(

''.Monde.'', 
'Internet',
'Afghanistan',
'Afrique du Sud',
'Albanie',
'Alg&eacute;rie',
'Allemagne',
'Andorre',
'Angola',
'Antigua et Barbuda',
'Arabie Saoudite', 
'Argentine',
'Arm&eacute;nie',
'Australie',
'Autriche',
'Azerba&iuml;djan',
'Bahamas',
'Bahre&iuml;n',
'Bangladesh',
'Barbade',
'Belgique', 
'B&eacute;lize',
'B&eacute;nin',
'Bhoutan',
'Bi&eacute;lorussie',
'Birmanie',
'Bolivie',
'Bosnie Herz&eacute;govine',
'Botswana',
'Br&eacute;sil',
'Brunei', 
'Bulgarie',
'Burkina Faso',
'Burundi',
'Cambodge',
'Cameroun',
'Canada',
'Cap-Vert',
'Centrafrique',
'Chili',
'Chine', 
'Chypre',
'Colombie',
'Comores',
'Congo Kinshasa',
'Congo Brazzaville',
'Cor&eacute;e du Nord',
'Cor&eacute;e du Sud',
'Costa Rica',
'C&ocirc;te d\'Ivoire',
'Croatie',
'Cuba',
'Danemark',
'Djibouti',
'R&eacute;publique dominicaine',
'Dominique',
'&eacute;gypte',
'&eacute;mirats arabes unis',
'&eacute;quateur',
'&eacute;rythr&eacute;e',
'Espagne',
'Estonie',
'&eacute;tats Unis',
'&eacute;thiopie',
'Fidji',
'Finlande',
'France',
'Gabon',
'Gambie',
'G&eacute;orgie',
'Ghana',
'Gr&egrave;ce',
'Grenade',
'Guatemala',
'Guin&eacute;e',
'Guin&eacute;e Bissau',
'Guin&eacute;e &eacute;quatoriale',
'Guyana',
'Ha&iuml;ti',
'Honduras',
'Hongrie',
'Inde',
'Indon&eacute;sie',
'Irak',
'Iran',
'Irlande',
'Islande',
'Isra&euml;l',
'Italie',
'Jama&iuml;que',
'Japon',
'Jordanie',
'Kazakhstan',
'Kenya',
'Kirghizistan',
'Kiribati',
'Kowe&iuml;t',
'Laos',
'Lesotho',
'Lettonie',
'Liban',
'Liberia',
'Libye',
'Liechtenstein',
'Lituanie',
'Luxembourg',
'Mac&eacute;doine',
'Madagascar',
'Malaisie',
'Malawi',
'Maldives',
'Mali',
'Malte',
'Maroc',
'Marshall',
'Maurice',
'Mauritanie',
'Mexique',
'Micron&eacute;sie',
'Moldavie',
'Monaco',
'Mongolie',
'Mont&eacute;n&eacute;gro',
'Mozambique',
'Namibie',
'Nauru',
'N&eacute;pal',
'Nicaragua',
'Niger',
'Nigeria',
'Norv&egrave;ge',
'Nouvelle Z&eacute;lande',
'Oman',
'Ouganda',
'Ouzb&eacute;kistan',
'Pakistan',
'Palau',
'Palestine',
'Panama',
'Papouasie Nouvelle Guin&eacute;e',
'Paraguay',
'$pays Bas',
'P&eacute;rou',
'Philippines',
'Pologne',
'Portugal',
'Qatar',
'Roumanie',
'Royaume Uni',
'Russie',
'Rwanda',
'Saint Kitts et Nevis',
'Sainte Lucie',
'Saint Marin',
'Saint Vincent et les Grenadines',
'Salomon',
'Salvador',
'Samoa',
'Sao Tom&eacute; et Principe',
'S&eacute;n&eacute;gal',
'Serbie',
'Seychelles',
'Sierra Leone',
'Singapour',
'Slovaquie',
'Slov&eacute;nie',
'Somalie',
'Soudan',
'Soudan du Sud',
'Sri Lanka',
'Su&egrave;de',
'Suisse',
'Suriname',
'Swaziland',
'Syrie',
'Tadjikistan',
'Tanzanie',
'Tchad',
'R&eacute;publique tch&egrave;que',
'Tha&iuml;lande',
'Timor Leste',
'Togo',
'Tonga',
'Trinit&eacute; et Tobago',
'Tunisie',
'Turkm&eacute;nistan',
'Turquie',
'Tuvalu',
'Ukraine',
'Uruguay',
'Vanuatu',
'Vatican',
'Venezuela',
'Vietnam',
'Y&eacute;men',
'Zambie',
'Zimbabwe'

);  

foreach ($world as $world1) { 
echo'<option>'.$world1.'</option>';
 } 

echo'</select><br/>

<span class="input-group-addon">Photo</span><input class="form-control" type="text" id="photo" name="photo" /><br/>
<span class="input-group-addon">Activite</span><input class="form-control" type="text" id="activite" name="activite" /><br/>
<span class="input-group-addon">Biographie</span><input class="form-control" type="text" id="biographie" name="biographie" /><br/>
<span class="input-group-addon">Loisirs</span><input class="form-control" type="text" id="loisirs" name="loisirs" /><br/>

<span class="input-group-addon">Code</span><input class="form-control" required  type="password" id="code" name="code" />
';

echo'<br /><center><input type="submit" value="Ok" /></center><br /></form>';
}
}

/* Sert à éditer un lien existant */

function editer_users() {

include('../db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video

$id = (int) $_GET['id'];

$salt = 'BwGk15l8WX'; 

$reponse = $bdd->query('SELECT * FROM utilisateurs WHERE ID = '.$id.' ');  

if(!isset($_GET['id'])) {
	header('Location: index.php?page=listeutilisateurs');
	exit();
}

if( isset($_POST['prenoms']) && isset($_POST['nom'])) {

$prenoms = htmlentities($_POST['prenoms'],null,'UTF-8');
$nom = htmlentities($_POST['nom'],null,'UTF-8');
$pays = htmlentities($_POST['pays'],null,'UTF-8');
$photo = htmlentities($_POST['photo'],null,'UTF-8');
$activite = htmlentities($_POST['activite'],null,'UTF-8');
$biographie = htmlentities($_POST['biographie'],null,'UTF-8');
$loisirs = htmlentities($_POST['loisirs'],null,'UTF-8');
$code = sha1($_POST['code'].$salt);
$id = (int) $_GET['id'];

$req = $bdd->prepare('UPDATE utilisateurs SET prenoms = :prenoms, nom = :nom, pays = :pays, photo = :photo, activite = :activite, biographie = :biographie, loisirs = :loisirs , code = :code WHERE ID= :id');

$req->execute(array(
	'prenoms' => $prenoms,
	'nom' => $nom,
	'pays' => $pays,
	'photo' => $photo,
	'activite' => $activite,
	'biographie' => $biographie,
	'loisirs' => $loisirs,
	'code' => $code,
	'id' => $id
));

header('Location: index.php?page=listeutilisateurs&messages=editerok');

} else {

while ($donnees = $reponse->fetch())
{

	echo'<form action="" method="POST">
	<label for="chapo" class="input-group-addon">Prenoms : &nbsp;</label><input class="form-control" type="text" name="prenoms" id="prenoms" rows="" cols="" value="'.$donnees['prenoms'].'" /><br />
	<label for="chapo" class="input-group-addon">Nom : &nbsp;</label><input class="form-control" type="text" name="nom" id="nom" rows="" cols="" value="'.$donnees['nom'].'" />
	<br />
	<label for="chapo" class="input-group-addon">Pays : &nbsp;</label><input class="form-control" type="text" name="pays" id="pays" rows="" cols="" value="'.$donnees['pays'].'" /><br />
	
	<label for="chapo" class="input-group-addon">Photo : &nbsp;</label><input class="form-control" type="text" name="photo" id="photo" rows="" cols="" value="'.$donnees['photo'].'" /><br />
	
	<label for="chapo" class="input-group-addon">Activite : &nbsp;</label><input class="form-control" type="text" name="activite" id="activite" rows="" cols="" value="'.$donnees['activite'].'" /><br />
	<label for="chapo" class="input-group-addon">Biographie : &nbsp;</label><input class="form-control" type="text" name="biographie" id="biographie" rows="" cols="" value="'.$donnees['biographie'].'" /><br />
	<label for="chapo" class="input-group-addon">Loisirs : &nbsp;</label><input class="form-control" type="text" name="loisirs" id="loisirs" rows="" cols="" value="'.$donnees['loisirs'].'" /><br />

<label for="code" class="input-group-addon">Code: &nbsp;</label><input class="form-control" required type="password" name="code" id="code" rows="" cols="" />';

	
echo'<br /><center><input type="submit" value="Ok" /></center><br /></form>';
}	$reponse->closeCursor();
}
}

/* Sert à supprimer un lien */

function supprimer_users() {

include('../db.php');

// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM utilisateurs');

if(!isset($_GET['id'])) {

	header('Location: index.php?page=listeutilisateurs');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `utilisateurs` WHERE `utilisateurs`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

header('Location: index.php?page=listeutilisateurs&messages=supprimerok');

}

?>
