<?php

/**
 * Tutoriel file
 * Description : Odf object with configuration array
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

$config = array(
    'ZIP_PROXY' => 'PhpZipProxy', // Make sure you have Zip extension loaded
    'DELIMITER_LEFT' => '#', // Yan can also change delimiters
    'DELIMITER_RIGHT' => '#'
);

$odf = new Odf("tutoriel7.odt", $config);

$odf->setVars('titre', 'PHP: Hypertext PreprocessorPHP: Hypertext Preprocessor');

$message = "PHP (sigle de PHP: Hypertext Preprocessor), est un langage de scripts libre 
principalement utilis� pour produire des pages Web dynamiques via un serveur HTTP, mais 
pouvant �galement fonctionner comme n'importe quel langage interpr�t� de fa�on locale, 
en ex�cutant les programmes en ligne de commande.";

$odf->setVars('message', $message);

// We export the file
$odf->exportAsAttachedFile();
 
?>