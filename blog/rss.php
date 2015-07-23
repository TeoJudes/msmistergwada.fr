<?php

header("Content-type: application/rss+xml; charset=UTF-8");
echo "<?".'xml version="1.0" encoding="UTF-8"'."?>"."\n";
echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n";
echo '<channel>'."\n";

include('db.php');

$reponsec = $bdd->query('SELECT * FROM configuration WHERE ID = 1');

while ($donnees = $reponsec->fetch())
{

$xml = '<title>'.$donnees['titre'].'</title>'."\n";
$xml .= '<link>'.$donnees['adressedusite'].'</link>'."\n"; 
$xml .= '<atom:link href="'.$donnees['adressedusite'].'/rss.php" rel="self" type="application/rss+xml" />'."\n"; 
$xml .= '<description></description>'."\n"; 
$xml .= '<language>fr</language>'."\n"; 
$xml .= '<copyright></copyright>'."\n";

}

$reponse = $bdd->query('SELECT * FROM articles ORDER BY id DESC');

while ($donnees = $reponse->fetch())
{

$timestamp = date_default_timezone_set('Europe/Brussels');

$timestamp = mktime (0, 0, 0, $donnees['mois'], $donnees['jour'], $donnees['annee']);
$date822 = date("r", $timestamp);

$donnees['titre'] = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i","\\1", $donnees['titre'] );
$donnees['titre'] = preg_replace("`\[.*\]`U","",$donnees['titre']);
$donnees['titre'] = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$donnees['titre']);
$donnees['titre'] = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $donnees['titre']);
$donnees['titre'] = ( $donnees['titre'] == "" ) ? $type : strtolower(trim($donnees['titre'], '-'));

$item = '<item>'."\n";
$item .= '<title>'.$donnees['titre'].'</title>'."\n";
$item .= '<guid isPermaLink="false">'.$donnees['titre'].'</guid>'."\n";
$item .= '<link></link>'."\n";
$item .= '<pubDate>'.$date822.'</pubDate>'."\n";
$item .= '<description><![CDATA['.$donnees['contenu'].']]></description>'."\n";
$xml .= $item.'</item>'."\n";
			
}

echo $xml;

echo '</channel>'."\n";
echo '</rss>';

?>
