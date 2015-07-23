<?php

/* Affiche le titre de l'article */

function tarticles()  {

include('db.php');

if (isset($_GET['id'])){ 

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM articles WHERE ID = '.$id.' ');
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

/* Affiche le contenu de l'article */

function articles()  {   

include('db.php');

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM articles WHERE ID = '.$id.' ');
$reponsec = $bdd->query('SELECT * FROM commentaires WHERE articles = '.$id.' ');

if(!isset($_GET['id'])) {
	header('Location: index.php?module=listearticles');
	exit();
}

while ($donnees = $reponse->fetch())
{

echo'

<div class="input-prepend" style="width: 99%;">
<span class="add-on" style="width: 25%; padding: 4px 0px;">Auteur : </span><span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">';

$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo '<a href="index.php?module=utilisateurs&id='.$donnees['auteur'].'">'.$donneesd['prenoms'].' '.$donneesd['nom'].'</a>';
} 

echo'</span> - 
<span class="add-on" style="width: 25%; padding: 4px 0px;">Titre : </span><span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['titre'].'</span> - 
<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['jour'].'</span>
/<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['mois'].'</span>
/<span class="add-on" style="background:white !important; width: 75%; padding: 4px 0px;">'.$donnees['annee'].'</span><br /><br />

</div>';

echo'<div style="

display: inline-block;
  margin-top: -10px;
  font-size: 0;
  vertical-align: middle;
  
width: 97.5%;
background-color: rgb(255, 255, 255);
border: 1px solid rgb(212, 212, 212);
font-size: 110%;padding-left:10px;padding-top:10px;padding-bottom:10px;padding-right:10px;"><p>';

if ($donnees['image'] == '') {
echo'<img src="articlevide.gif" class="img-responsive"  style="height:200px;width:100%;margin:auto;">';
} 
else {
echo'<img src="'.$donnees['image'].'" class="img-responsive" style="height:300px;width:100%;margin:auto;">';
}



echo' '.$donnees['contenu'].'</p></div><br/><br/><p><strong>Commentaires :</strong></p>
';

}

while ($donnees = $reponsec->fetch())
{

echo'<div style="

display: inline-block;
  margin-top: -10px;
  font-size: 0;
  vertical-align: middle;
  
width: 97.5%;
background-color: rgb(255, 255, 255);
font-size: 110%;padding-top:10px;padding-bottom:10px;">
<label for="titre" class="input-group-addon">'.$donnees['pseudo'].'</label> 
<input class="form-control" type="text" required name="titre" id="titre" placeholder="'.$donnees['contenu'].'" /></div><br/><br/>';	
}

include('db.php');
 
$id = (int) $_GET['id'];

$reponsed = $bdd->query('SELECT * FROM commentaires WHERE articles = '.$id.' '); 

if( isset($_POST['pseudo']) && isset($_POST['contenu'])) {

$pseudo = htmlentities($_POST['pseudo'],null,'UTF-8');
$contenu = htmlentities($_POST['contenu'],null,'UTF-8');
$articles = (int) $_GET['id'];

$req = $bdd->prepare('INSERT INTO commentaires(pseudo, contenu, articles) VALUES(:pseudo, :contenu, :articles)');

$req->execute(array(
	'pseudo' => $pseudo,
	'contenu' => $contenu,
	'articles' => $articles
));
	
      echo '<div id="valide"><p>Le commentaire a bien été ajouté.</p></div>';
      echo '<br />';
      echo '<center><a href="index.php?module=articles&id='.$id.'">Retour</a></center>';
}
else {

	echo'<form action="" method="post">
	
	<div class="input-group" style="width: 98%;"/>
	<span class="input-group-addon" style="width: 10%; padding: 4px 0px;">Pseudo</span>
	<input class="form-control" type="text" required name="pseudo" id="pseudo" placeholder="votre pseudo."/>
    </div>

<br/><textarea class="form-control" name="contenu" required id="contenu" rows="" placeholder="Votre message : suggestions, remarques ou autre." cols="" style="width: 98%;height: 200px;"></textarea><br />';

	echo'<center><input  class="btn" type="submit" value="Ok" /></center></form><br/>';
  
}
echo'</div></div></div>';
}

/* Affiche la liste des articles */

function articlesliste() {

include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM articles ORDER BY id DESC');


while ($donnees = $reponse->fetch())
{
	$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 
	echo '
	<h2>
         <a href="#">'.$donnees['titre'].'</a>
                </h2>
                <p>Posté le '.$donnees['jour'].'/'.$donnees['mois'].'/'.$donnees['annee'].' </p>
                <hr>
                <img  src="'.$donnees['image'].'" class="img-responsive" style="height:300px;width:900px;margin:auto;">
                <hr>
                <a class="btn btn-primary" href="index.php?module=articles&id='.$donnees['ID'].'">Lire la suite <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
                ';

}
echo'
            
          </div></div></div>';

echo'';

}

/* Affiche la liste des articles (Administration) */

function liste_news() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM articles WHERE auteur= '.$_SESSION['pseudo'].' ORDER BY id DESC ');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Titre</center></th><th class="visible-desktop"><center>Date</center></th><th class="visible-desktop"><center>Auteur</center></th><th><center>Supprimer</center></th><th><center>Editer</center></th></tr></thead><thead>';

while ($donnees = $reponse->fetch())
{

echo'
<tr >
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
echo'</center></td><td><center><a href="index.php?page=supprimer&id='.$donnees['ID'].'");"><img src="images/supprimer.png" alt="Supprimer" width="16px"></a></center></td><td><center><a href="index.php?page=editer&id='.$donnees['ID'].'"><img src="images/edition.png" alt="Editer" width="16px"></a></center></td></tr></thead>';

} 

echo'</table>';
echo'<a href="index.php?page=ajouter" title="Ecrire" style="text-align:center;text-decoration:none;"><i><img src="images/ecrire.png"></i> Ecrire un nouvel article</a>';


} 

/* Sert à écrire un article */

function ajout_news() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM articles');

if(isset($_POST['titre']) && isset($_POST['auteur']) && isset($_POST['contenu']) && isset($_POST['chapo']) && isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['annee'])  && isset($_POST['image'])) {

$titre = htmlentities($_POST['titre'],null,'UTF-8');
$contenu = htmlentities($_POST['contenu'],ENT_QUOTES,'UTF-8');

$in = '(&lt;(/?(?:strong|p|em|a|ol|ul|li|img|iframe)\b.*?)&gt;)';

$contenu = preg_replace_callback(
    $in, // sans le modificateur e et en corrigeant le délimiteur
    function ($match) {
        return '<' . html_entity_decode($match[1], ENT_QUOTES, 'UTF-8') . '>';
    },
    $contenu
);

$contenu = str_replace(array(

':)'
,':('
,'XD'
,':D'
,':p'
,':o'
,'&lt;br&gt;'
,'&lt;br /&gt;'
,'&amp;nbsp;'
,'&amp;lt;3'

), 

array(

'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Content.png" alt=":)" class="" />'
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Embarrassed.png" alt=":(" class="" />'
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Grin.png" alt="XD" class="" />'
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Laughing.png" alt=":D" class="" />'
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Yuck.png" alt=":p" class="" />'
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/Gasp.png" alt=":o" class="" />'
,'<br />'
,'<br />'
,' '
,'<img src="'.base64_decode($tableau[5]).'/admin/images/smileys/HeartEyes.png" alt="<3" class="" />'

), $contenu);

     $auteur = htmlentities($_POST['auteur'],null,'UTF-8');
     $chapo = htmlentities($_POST['chapo'],null,'UTF-8');
     $jour = htmlentities($_POST['jour'],null,'UTF-8');
     $mois = htmlentities($_POST['mois'],null,'UTF-8');
     $annee = htmlentities($_POST['annee'],null,'UTF-8');
     $image = htmlentities($_POST['image'],null,'UTF-8');

$req = $bdd->prepare('INSERT INTO articles(auteur, titre, jour, mois, annee, contenu, chapo, image) VALUES(:auteur, :titre, :jour, :mois, :annee, :contenu, :chapo, :image)');

$req->execute(array(
	'auteur' => $auteur,
	'titre' => $titre,
	'jour' => $jour,
	'mois' => $mois,
	'annee' => $annee,
	'contenu' => $contenu,
	'chapo' => $chapo,
	'image' => $image

));
	
header('Location: index.php?page=liste&messages=creerok');

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
<label for="titre" class="input-group-addon">'.Titre.'</label> 
<input class="form-control" type="text" required name="titre" id="titre" placeholder="'.Articla.'" /><br/>

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

<br /><label class="input-group-addon" for="chapo"> '.Chapo.'</label><input class="form-control" type="text" required name="chapo" id="chapo" rows="" cols="" placeholder="'.Articlb.'">

<br /><label class="input-group-addon" for="chapo"> Image</label><input class="form-control" type="text" required name="image" id="image" rows="" cols="" placeholder="'.Articlb.'"><br />';

echo'<textarea class="form-control" name="contenu" id="contenu" rows="" cols="" style="width: 100%;height: 400px;"></textarea>
<br/><center><input type="submit" value="Ok" /></center></form>';
}
}

/* Sert à éditer un article */

function editer_news() {

include('../db.php');

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM articles WHERE ID = '.$id.' '); 

if(!isset($_GET['id'])) {
	header('Location: index.php?page=liste');
	exit();
}

if(isset($_POST['titre']) && isset($_POST['contenu'])) {
$titre = htmlentities($_POST['titre'],null,'UTF-8');
$jour = htmlentities($_POST['jour'],null,'UTF-8');
$mois = htmlentities($_POST['mois'],null,'UTF-8');
$annee = htmlentities($_POST['annee'],null,'UTF-8');
$image = htmlentities($_POST['image'],null,'UTF-8');
$contenu = htmlentities($_POST['contenu'], ENT_QUOTES,'UTF-8');
$id = (int) $_GET['id'];

$in = '(&lt;(/?(?:strong|p|em|a|ol|ul|li|img|iframe)\b.*?)&gt;)';

$contenu = preg_replace_callback(
    $in, // sans le modificateur e et en corrigeant le délimiteur
    function ($match) {
        return '<' . html_entity_decode($match[1], ENT_QUOTES, 'UTF-8') . '>';
    },
    $contenu
);

$contenu = str_replace(array(

':)'
,':('
,'XD'
,':D'
,':p'
,':o'
,'&lt;br&gt;'
,'&lt;br /&gt;'
,'&amp;nbsp;'
,'&amp;lt;3'

), 

array(

'<img src="/admin/images/smileys/Content.png" alt=":)" class="" />'
,'<img src="/admin/images/smileys/Embarrassed.png" alt=":(" class="" />'
,'<img src="/admin/images/smileys/Grin.png" alt="XD" class="" />'
,'<img src="/admin/images/smileys/Laughing.png" alt=":D" class="" />'
,'<img src="/admin/images/smileys/Yuck.png" alt=":p" class="" />'
,'<img src="/admin/images/smileys/Gasp.png" alt=":o" class="" />'
,'<br />'
,'<br />'
,' '
,'<img src="/admin/images/smileys/HeartEyes.png" alt="<3" class="" />'

), $contenu);

$chapo = htmlentities($_POST['chapo'],null,'UTF-8');
$id = (int) $_GET['id'];

$req = $bdd->prepare('UPDATE articles SET titre = :titre, jour = :jour, mois = :mois, annee = :annee, contenu = :contenu, chapo = :chapo, image = :image WHERE ID= :id');

$req->execute(array(
	'titre' => $titre,
	'jour' => $jour,
	'mois' => $mois,
	'annee' => $annee,
	'contenu' => $contenu,
	'chapo' => $chapo,
	'image' => $image,
	'id' => $id
));

header('Location: index.php?page=liste&messages=editerok');

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
<label for="titre" class="input-group-addon">Titre</label> 
<input class="form-control" type="text" required name="titre" id="titre" value="'.$donnees['titre'].'" />
<br />
<label for="jour" class="input-group-addon">Jour</label> 
<input class="form-control" type="text" name="jour" id="jour" value="'.$donnees['jour'].'" readonly="readonly" / >
<br />
<label for="mois" class="input-group-addon">Mois</label> 
<input class="form-control" type="text" name="mois" id="mois" value="'.$donnees['mois'].'" readonly="readonly" /> 
<br />
<label for="annee" class="input-group-addon">Annee</label>
<input class="form-control" type="text" name="annee" id="annee" value="'.$donnees['annee'].'" readonly="readonly" /> 
<br />
<label for="chapo" class="input-group-addon">Chapo</label>
<input class="form-control" type="text" required name="chapo" id="chapo" rows="" cols="" value="'.$donnees['chapo'].'">
<br />
<label for="image" class="input-group-addon">Image</label>
<input class="form-control" type="text" required name="image" id="image" rows="" cols="" value="'.$donnees['image'].'">
<br />

<textarea class="form-control" name="contenu" id="contenu" rows="" cols="" style="width: 100%;height: 400px;">'.$donnees['contenu'].'</textarea>
<br />
<center><input type="submit" value="Ok" /></center>
	</form>';

}	
}
}

/* Sert à supprimer un article */

function supprimer_news() {

include('../db.php');

$reponse = $bdd->query('SELECT * FROM articles');


if(!isset($_GET['id'])) {

	header('Location: index.php?page=liste');

	exit();
}

$id = (int) $_GET['id'];

$req = $bdd->prepare('DELETE FROM `articles` WHERE `articles`.`ID` =:nom');

$req->execute(array(
	'nom' => $id
));

header('Location: index.php?page=liste&messages=supprimerok');

}

?>
