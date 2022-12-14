<?php

/**
 * Tutoriel file
 * Description : Imbricating several segments
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

$odf = new Odf("tutoriel4.odt");

$odf->setVars('titre','Articles disponibles :');

$categorie = $odf->setSegment('categories');
for ($j = 1; $j <= 2; $j++) {
    $categorie->setVars('TitreCategorie', 'Catégorie ' . $j);
    for ($i = 1; $i <= 3; $i++) {
        $categorie->articles->titreArticle('Article ' . $i);
        $categorie->articles->date(date('d/m/Y'));
        $categorie->articles->merge();
    }
    for ($i = 1; $i <= 4; $i++) {   
        $categorie->commentaires->texteCommentaire('Commentaire ' . $i);
        $categorie->commentaires->merge();        
    }
    $categorie->merge();
}
$odf->mergeSegment($categorie);

// We export the file
$odf->exportAsAttachedFile();
 
?>
