<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
<title>Inu Cms</title>
<style type="text/css">
body {
    margin: 0px;
    padding: 0px;
    font-family: Verdana;
    font-size:12px;
}
#news {
background:black;
color:white;
margin-top:20px;
    margin-left: auto;
 margin-right: auto;
padding: auto;
text-align:center;
    width: 600px;
border-style:solid;
border-width:5px;
}
</style>
</head>
<body>
<div id="news">
<h2>Identification</h2>
<form action="login.php" method="post">
<p>Utilisateur<p></p>
<?php 

include('../db.php');

echo'<select class="form-control" id="login" name="login">';

$reponse2 = $bdd->query('SELECT * FROM utilisateurs'); 

while ($donnees2 = $reponse2->fetch())
 {

echo'<option value="'.$donnees2['ID'].'">'; echo $donnees2['prenoms']; echo' '; echo $donnees2['nom']; echo'</option>';

 };

?>
 
echo'</select>
</p>
<p>Code de l'utilisateur<p></p>
<input type="password" name="code" /></p><p>
<input type="submit" value="Valider" /></p>
</form>
</div>
</body>
</html>
