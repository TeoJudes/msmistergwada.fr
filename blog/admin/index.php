<?php 
session_start();

error_reporting(0);

if($_SESSION['log'] != 1) {
	echo '<h1>Accès Interdit</h1>';
	exit;
}

include('../db.php');
include 'langues.php';
require 'fonctions.php';

$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1');

echo'

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../favicon.ico">

   <title>Administration
';

if (isset($_GET['page'])){ 
switch ($_GET['page'])
{

case 'amis': echo 'Amis'; break;

case 'partenaires': echo 'Partenaires'; break;

case 'liste': echo 'Articles'; break;

case 'supprimer': echo 'Articles'; break;

case 'ajouter': echo 'Ecrire'; break;

case 'listecommentaires': echo 'Commentaires'; break;

case 'supprimercommentaires': echo 'Commentaires'; break;

case 'listec': echo 'Contact'; break;

case 'editer': echo 'Editer'; break;

case 'images': echo 'Images'; break;

case 'upload': echo 'Images'; break;

case 'listeliens': echo 'Liens'; break;

case 'ajouterliens': echo 'Liens'; break;

case 'editerliens': echo 'Liens'; break;

case 'supprimerliens': echo 'Liens'; break;

case 'listeutilisateurs': echo 'Utilisateurs'; break;

case 'ajouterutilisateurs': echo 'Utilisateurs'; break;

case 'editerutilisateurs': echo 'Utilisateurs'; break;

case 'supprimerutilisateurs': echo 'Utilisateurs'; break;

case 'listemenu': echo 'Menus'; break;

case 'ajoutermenu': echo 'Menus'; break;

case 'editermenu': echo 'Menus'; break;

case 'supprimermenu': echo 'Menus'; break;

case 'delete': echo 'Images'; break;

case 'configuration': echo 'Configuration'; break;

} }

if (empty($_GET['page'])){ 

echo 'Accueil';

}
    
    echo'

    </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body>
  <body onload="whizzywig()">
<script src="editeur.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">addEvt(window,\'load\',whizzywig);</script>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>';



 echo' <a class="navbar-brand" href="#"> Administration</a></div>';

       echo' <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
          
  <li><a href="?page=liste" title="Articles"><i><img src="images/list.png"></i>  Mes articles</a></li>
  <li><a href="?page=listecommentaires" title="Commentaires"><i><img src="images/bulle.png"></i>  Nos Commentaires</a></li>
  <li><a href="?page=listeutilisateurs" title="Utilisateurs"><i><img width="13px" src="images/utilisateurs.png"></i>  Nos Utilisateurs</a></li>
  <li><a href="?page=images" title="Images"><i><img src="images/pictures.png"></i>  Nos Images</a></li>	
          
          
          
           
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
           <li><a href="?page=listec" title="Messages"><i class="fa fa-envelope"></i><img src="images/messages.png"></i> Mes messages</a></li>
              <li><a href="../" title="Blog" target="_blank"><i class="fa fa-envelope"><img src="images/eye.png"></i> Blog</a></li>	

                <li><a href="?page=configuration" title="Configuration"><i class="fa fa-envelope"></i><img src="images/configure.png"></i> Configuration</a></li>

              <li><a href="deconnexion.php" title="Deconnexion"><i class="fa fa-envelope"></i><img src="images/logout.png"></i> Deconnexion</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">';

if (isset($_GET['messages'])){ 
 switch ($_GET['messages'])
{

case 'creerok': echo'<p class="alert alert-success fade in"><button class="close" data-dismiss="alert">
					×
				</button>La création a bien été effectuée.</p>'; break;

case 'editerok': echo'<p class="alert alert-success fade in"><button class="close" data-dismiss="alert">
					×
				</button>L\'édition a bien été effectuée.</p>'; break;

case 'supprimerok': echo'<p class="alert alert-success fade in"><button class="close" data-dismiss="alert">
					×
				</button>La suppression a bien été effectuée.</p>'; break;

}}

if (empty($_GET['messages'])){ 

echo'';

}

if (isset($_GET['page'])){ 
 switch ($_GET['page'])
{

case 'liste': liste_news(); break;

case 'listec': liste_contact(); break;

case 'supprimerc': supprimer_contact(); break;

case 'listecommentaires': echo liste_commentaires(); break;

case 'supprimercommentaires': echo supprimer_commentaires(); break;

case 'supprimer': supprimer_news(); break;

case 'amis': module(); break;

case 'partenaires': module(); break;

case 'ajouter': anti_slash(); ajout_news(); break;

case 'editer': anti_slash(); editer_news(); break;

case 'images': formulaire_images(); images(); break;

case 'upload': envoyer_images(); break;

case 'delete': supprimer_images(); break;

case 'configuration': configuration(); break;

case 'listeliens': lienslisteadmin(); break;

case 'ajouterliens':  anti_slash(); ajout_liens(); break;

case 'editerliens': anti_slash(); editer_liens(); break;

case 'supprimerliens': supprimer_liens(); break;

case 'listeutilisateurs': userslisteadmin(); break;

case 'ajouterutilisateurs':  anti_slash(); ajout_users(); break;

case 'editerutilisateurs': anti_slash(); editer_users(); break;

case 'supprimerutilisateurs': supprimer_users(); break;

case 'listemenus': menuslisteadmin(); break;

case 'ajoutermenus':  anti_slash(); ajout_menus(); break;

case 'editermenus': anti_slash(); editer_menus(); break;

case 'supprimermenus': supprimer_menus(); break;

}}

if (empty($_GET['page'])){ 

accueil();

}

echo'
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

  </body>
</html>';

?>
