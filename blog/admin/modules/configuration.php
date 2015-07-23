<?php

/* Affiche le contenu de la page de configuration */ 

function configuration() {

include('../db.php');

$salt = 'BwGk15l8WX'; 

$reponse = $bdd->query('SELECT * FROM configuration WHERE ID = 1 ');  

if( isset($_POST['titre']) && isset($_POST['gerant'])) {

$titre = htmlentities($_POST['titre'],null,'UTF-8');
$gerant = htmlentities($_POST['gerant'],null,'UTF-8');
$disqus = htmlentities($_POST['disqus'],null,'UTF-8');
$adressedusite = htmlentities($_POST['adressedusite'],null,'UTF-8');
$lienadmin = htmlentities($_POST['lienadmin'],null,'UTF-8');

$id = (int) $_GET['id'];

$req = $bdd->prepare('UPDATE configuration SET titre = :titre, gerant = :gerant, disqus = :disqus, adressedusite = :adressedusite, lienadmin = :lienadmin WHERE ID= 1 ');

$req->execute(array(
	'titre' => $titre,
	'gerant' => $gerant,
	'disqus' => $disqus,
	'adressedusite' => $adressedusite,
	'lienadmin' => $lienadmin
));

header('Location: index.php?page=configuration&messages=editerok');

} else {

while ($donnees = $reponse->fetch())
{

	echo'<form action="" method="POST">
<label for="titre" class="input-group-addon">Titre</label> <input  class="form-control" type="text" required name="titre" id="titre"  placeholder="Titre du blog" value="'.$donnees['titre'].'" /> <br />

<label for="gerant" class="input-group-addon">Gerant</label>
<select class="form-control" id="gerant" name="gerant" value="'.$donnees['gerant'].'">';

$reponse2 = $bdd->query('SELECT * FROM utilisateurs');

while ($donnees2 = $reponse2->fetch())
 {

echo'<option>'; echo $donnees2['prenoms']; echo' '; echo $donnees2['nom']; echo'</option>';

 };
 
echo'</select> <br />

<label for="disqus" class="input-group-addon">Disqus</label><input  class="form-control" type="text" required placeholder="Disqus" name="disqus" id="disqus" rows="" cols="" value="'.$donnees['disqus'].'"/><br />

<label for="adressedusite" class="input-group-addon">Adresse du site</label><input  class="form-control" type="text" required placeholder="Adresse du site" name="adressedusite" id="adressedusite" rows="" cols="" value="'.$donnees['adressedusite'].'"/><br />

<br />

';

echo'
<center><input type="submit" value="Ok" /></center>
	</form>';
	
}}

}

?>
