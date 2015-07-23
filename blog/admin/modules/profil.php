<?php

//Affiche le titre de la page de profil.

function tutilisateurs()  {

include('db.php');

if (isset($_GET['id'])){ 

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM utilisateurs WHERE ID = '.$id.' ');
$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1 ');

while ($donnees = $reponse->fetch())
{
while ($donnees2 = $reponsec->fetch())
{
echo'<title>'.$donnees2['titre'].' - '.$donnees['prenoms'].' - '.$donnees['nom'].'</title>';	
}
}
}	

}

//Affiche le contenu de la page de profil.

function utilisateursliste() {

include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponsed = $bdd->query('SELECT * FROM utilisateurs');

echo'<style type="text/css">
.lead
{
overflow:hidden;
white-space:nowrap;
text-overflow: ellipsis;
width:200px;
padding:3px;
height:30px;
text-align:center;
}

</style>';

// On affiche chaque entrée une à une
while ($donneesc = $reponsed->fetch())
{
echo'
<div class="row" style="margin-left: 0px; margin-right: 0px;">
   <div class="col-sm-4">  
      
        <div class="panel panel-default">
          <div class="panel-thumbnail">';

if ($donneesc['photo'] == '') {
echo'<img src="photo.png" class="img-responsive"  style="height:200px;width:100%;margin:auto;">';
} 
else {
echo'<img src="'.$donneesc['photo'].'" class="img-responsive" style="height:200px;width:100%;margin:auto;">';
}

echo'</div>
          <div class="panel-body">
            <p class="lead" style="text-align:center;"><a href="index.php?module=utilisateurs&id='.$donneesc['ID'].'");">'.$donneesc['ID'].' - '.$donneesc['prenoms'].' '.$donneesc['nom'].' </a></p>';

echo' </div></div></div>';

}

}

function utilisateurs()  {

   echo' <div class="blog-masthead" style="margin-bottom:30px;">

      <div class="container">

        <nav class="blog-nav" style="text-align:center;color:white">Profil</nav></div></div>';

include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video

$id = (int) $_GET['id'];

$reponse = $bdd->query('SELECT * FROM utilisateurs WHERE ID = '.$id.' ');
 
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{

echo'<div style="

display: inline-block;
  margin-bottom: 20px;
  font-size: 0;
  vertical-align: middle;
  
width: 100%;
background-color: rgb(212, 212, 212);border: solid #DDDDDD;
border-radius: 4px;
border: 2px solid rgb(212, 212, 212);
font-size: 110%;padding-left:10px;padding-top:10px;padding-bottom:10px;padding-right:10px;"><br/><p class="text-center"><strong>Profil -

';
echo $donnees['prenoms']; echo' '; echo $donnees['nom'];

if (($donnees['prenoms']=='') && ($donnees['nom']=='')) {echo '';}

else {

echo' - '; 

echo $donnees['pays'];

echo' <img src="admin/images/pays/'.$donnees['pays'].'.png" alt="'.$donnees['pays'].'" style="border: black 1px solid;"></strong></p>';};

echo'<table>
<tr>
<td><img class="visible-desktop img-polaroid" src="';

if ($donnees['photo'] == '')  {

echo'photo.png'; }

else {

echo $donnees['photo']; }

echo'" alt="" style="border: solid #DDDDDD;
border-radius: 4px;
display: block;
height:200px;width:200px;
background-color:white;
margin-right:10px;"/></td>

<td style="padding:30px;">
<h2 style="
font-family:sans-serif;
font-size: 22px;
font-weight: 700;
line-height: 24px;
margin-bottom: 20px;
">';

echo $donnees['activite'];

echo'</h2>';

echo'<p>'.$donnees['biographie'].'</p><p><b>Loisirs  :</b> '.$donnees['loisirs'].'</p></td>';


echo'<td>';

echo'</td></tr></table></div>'; 

}
 
$reponse->closeCursor(); // Termine le traitement de la requête

   echo' <div class="blog-masthead" style="margin-bottom:30px;">

      <div class="container">

        <nav class="blog-nav" style="text-align:center;color:white">Liens</nav></div></div>';
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM liens WHERE auteur= '.$id.' ');

echo'<table class="table table-striped table-bordered" style="background:white;"><thead><tr>
<th><center>Titre</center></th><th><center>Date</center></th><th><center>Auteur</center></th></tr></thead>';

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


   echo' <div class="blog-masthead" style="margin-bottom:30px;">

      <div class="container">

        <nav class="blog-nav" style="text-align:center;color:white">Articles</nav></div></div>';
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video

$reponse = $bdd->query('SELECT * FROM articles WHERE auteur= '.$id.' ORDER BY id DESC ');

echo'<style type="text/css">
.lead
{
overflow:hidden;
white-space:nowrap;
text-overflow: ellipsis;
width:200px;
padding:3px;
height:30px;
}

</style>';

while ($donnees = $reponse->fetch())
{
	
echo'
<div class="row" style="margin-left: 0px; margin-right: 0px;">
   <div class="col-sm-4">  
      
        <div class="panel panel-default">
          <div class="panel-thumbnail">';

if ($donnees['image'] == '') {
echo'<img src="articlevide.gif" class="img-responsive"  style="height:129px;width:100%;margin:auto;">';
} 
else {
echo'<img src="'.$donnees['image'].'" class="img-responsive" style="height:129px;width:100%;margin:auto;">';
}

echo'</div>
          <div class="panel-body">
            <p class="lead"><a href="index.php?module=articles&id='.$donnees['ID'].'");">'.$donnees['titre'].'</a></p>
            <p>'.$donnees['jour'].'/'.$donnees['mois'].'/'.$donnees['annee'].' - ';


$reponsed = $bdd->query('SELECT * FROM utilisateurs WHERE id = '.$donnees['auteur'].' '); 

while ($donneesd = $reponsed->fetch())
{
echo '<a href="index.php?module=utilisateurs&id='.$donnees['auteur'].'">'.$donneesd['prenoms'].' '.$donneesd['nom'].'</a>';
} 

echo'</p>
            
          </div></div></div>';

}

echo'';

}

?>
