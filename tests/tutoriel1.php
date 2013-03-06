<?php

/**
 * Tutoriel file
 * Description : Simple substitutions of variables
 * You need PHP 5.2 at least
 * You need Zip Extension or PclZip library
 *
 * @copyright  GPL License 2008 - Julien Pauli - Cyril PIERRE de GEYER - Anaska (http://www.anaska.com)
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL License
 * @version 1.3
 */


// Make sure you have Zip extension or PclZip library loaded
// First : include the librairy
require_once('../library/odf.php');

$odf = new odf("tutoriel1.odt");

$odf->setVars('titre', 'PHP: Hypertext PreprocessorPHP: Hypertext Preprocessor');

$message = "PHP (sigle de PHP: Hypertext Preprocessor), est un langage de scripts libre 
principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP, mais 
pouvant également fonctionner comme n'importe quel langage interprété de façon locale, 
en exécutant les programmes en ligne de commande.";

$odf->setVars('message', $message);

// We export the file
$odf->exportAsAttachedFile();
 
?>