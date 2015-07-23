<?php

require 'admin/fonctions2.php';
include('db.php');

error_reporting(E_ALL);

$filename = 'install.php';

if (file_exists($filename)) {
if (filesize('db.php') > 0) {

 unlink('install.php');

}

else { header('Location: install.php'); }
} else {
    echo "";
}



//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);

$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1');

echo '

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.ico">';

if (isset($_GET['module'])){ 
switch ($_GET['module'])
{
    
    case 'articles':
        tarticles();
        break;
    
    case 'listearticles':
while ($donnees = $reponsec->fetch())
{

        echo '<title>'.$donnees['titre'].' - Liste des articles </title>';

}
        break;
    
    case 'contact':
        tcontact();
        break;
    
    case 'erreurs':
        terreurs();
        break;

    case 'listeliens':

while ($donnees = $reponsec->fetch())
{

        echo '<title>'.$donnees['titre'].' - Liste des liens </title>';
        break;

}

    case 'liens':
        tliens();
        break;

    case 'utilisateurs':
        tutilisateurs();
        break;
    
    case 'listeutilisateurs':
while ($donnees = $reponsec->fetch())
{

 	echo '<title>'.$donnees['titre'].' - Liste des utilisateurs </title>';
        break;
  }      
}}

if (empty($_GET['module'])){ 

while ($donnees = $reponsec->fetch())
{

        echo '<title>'.$donnees['titre'].'</title>';

}
}

echo'
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/css/blog.css" rel="stylesheet">

  </head>

  <body>
 <div class="blog-header">';

$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1');

while ($donnees2 = $reponsec->fetch())
{

      echo'<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">'.$donnees2['titre'].'</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="http://isnenroute.fr">Accueil</a>
                    </li>
                    <li>
                        <a href="index.php?module=articles">Blog</a>
                    </li>
                    <li>
                        <a href="index.php?module=contact">Contact</a>
                    </li>
                    <li>
                        <a href="admin/connexion.php">Administration</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container --> ';
}


include('db.php');
 
// Si tout va bien, on peut continuer
 
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM menus');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{

echo '<a href="' . $donnees['lien'] . '" target="_blank" style=" text-transform : capitalize;" class="blog-nav-item"><i class="icon-arrow-right"></i><img src="bootstrap/images/menus.png" class="blog-nav-item" alt="' . $donnees['lien'] . '" title="' . $donnees['lien'] . '"></a>';	
}; 

echo '        

        </nav>

    <div class="container">

     

      <div class="row">

        <<div class="col-md-8">

                <h1 class="page-header">
                    Blog ISN
                </h1>

        ';

if (isset($_GET['module'])){ 

switch ($_GET['module'])
{
    
    case 'articles':
        articles();
        break;
    
    case 'listearticles':
        articlesliste();
        break;


    case 'liens':
        liens();
        break;

    case 'listeliens':
        liensliste();
        break;
    
    case 'contact':
        ajout_contact();
        break;
    
    case 'erreurs':
        erreurs();
        break;
    
    case 'amis':
        module();
        break;
    
    case 'partenaires':
        module();
        break;
    
    case 'utilisateurs':
        utilisateurs();
        break;

    case 'listeutilisateurs':
        utilisateursliste();
        break;
    
    case 'admin':
        header('Location: admin ');
		break;

}}

if (empty($_GET['module'])){ 

include('db.php');
 
$reponsed = $bdd->query('SELECT * FROM utilisateurs');

echo'
';

echo'Ceci sera la page d\'accueil</div>';

header('Location: index.php?module=listearticles');

}


echo'
            
            <div class="col-md-4">
                <!-- Side Widget Well -->
                <hr>
                <div class="well">
                    <h4>Liens utiles</h4>
                        <ul>
                            <li> <a href = " http://www.w3schools.com/html/html5_intro.asp"> Le site de W3C school tutoriel HTML </a> </li>
                            <li> <a href ="http://www.w3schools.com/tags/tag_nav.asp"> Toutes les balises de HTML5 site de W3C </a> </li>
                             <li> <a href ="http://www.w3schools.com/css/default.asp"> Le site de W3C school tutoriel CSS </a> </li>
                            <li> <a href ="http://www.w3schools.com/cssref/default.asp"> Toutes les balises de CSS3 site de W3C </a></li>
                             <li> <a href =" http://fsincere.free.fr/isn/html/cours_html.php" > Site d \'un professeur d\'ISN Mr Sincere </a></li>
                             <li> <a href = "http://fr.openclassrooms.com/informatique/cours/apprenez-a-programmer-en-c" > Site OpenClassroom (site du zéro) </a></li>


                        </ul>
                </div>

            </div>

        </div>

        <hr>';
    include('admin/includes/footer.php');
      echo'
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>';

?>
