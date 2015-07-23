<?php

function liste_commentaires() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM commentaires');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Pseudo</center></th><th><center>Commentaire</center></th><th><center>Article</center></th><th><center>Supprimer</center></th></tr></thead>';
 
while ($donnees = $reponse->fetch())
{

echo'
<thead><tr >
<td>';
echo $donnees['pseudo'];
echo'</td>
<td>';
echo $donnees['contenu'];
echo'</td>
<td>';
echo'<a href="http://127.0.0.1/Inusql/index.php?module=articles&id='.$donnees['articles'].'" target="_blank"><center> '.$donnees['articles'].' </center<</a>';
echo'</td>';
echo'<td><center><a href="index.php?page=supprimercommentaires&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td></tr></thead>';

}
echo'</table>';
} 

function supprimer_commentaires() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM commentaires');

if(!isset($_GET['id'])) {

	header('Location: index.php?page=listecommentaires');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `commentaires` WHERE `commentaires`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

	header('Location: index.php?page=listecommentaires&messages=supprimerok');

}

?> 
