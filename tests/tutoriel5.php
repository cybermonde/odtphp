<?php

/**
 * Tutoriel file
 * Description : Merging a Segment with some data and additional pictures
 * You need PHP 5.2 at least
 * You need Zip Extension or PclZip library
 *
 * @copyright  GPL License 2008 - Julien Pauli - Cyril PIERRE de GEYER - Anaska (http://www.anaska.com)
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL License
 * @version 1.3
 */


// Make sure you have Zip extension or PclZip library loaded
// First : include the librairy
require_once('../library/Odf.php');

$odf = new Odf("tutoriel5.odt");

$odf->setVars('titre', 'Quelques articles de l\'encyclop�die Wikip�dia');

$message = "La force de cette encyclop�die en ligne r�side dans son nombre important de 
 contributeurs. Ce sont en effet des millions d'articles qui sont disponibles dans la langue 
 de Shakespeare et des centaines de milliers d'autres dans de nombreuses langues dont 
 le fran�ais, l'espagnol, l'italien, le turc ou encore l'allemand.";

$odf->setVars('message', $message);

$listeArticles = array(
	array(	'titre' => 'PHP',
			'texte' => 'PHP (sigle de PHP: Hypertext Preprocessor), est un langage de scripts (...)',
			'image' => './images/php.gif'
	),
	array(	'titre' => 'MySQL',
			'texte' => 'MySQL est un syst�me de gestion de base de donn�es (SGDB). Selon le (...)',
			'image' => './images/mysql.gif'
	),
	array(	'titre' => 'Apache',
			'texte' => 'Apache HTTP Server, souvent appel� Apache, est un logiciel de serveur (...)',
			'image' => './images/apache.gif'
	)
);

$article = $odf->setSegment('articles');
foreach($listeArticles AS $element) {
	$article->titreArticle($element['titre']);
	$article->texteArticle($element['texte']);
	$article->setImage('image', $element['image']);
	$article->merge();
}
$odf->mergeSegment($article);

// We export the file
$odf->exportAsAttachedFile();
 
?>