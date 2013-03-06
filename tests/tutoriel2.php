<?php

/**
 * Tutoriel file
 * Description : Adding a single image to the document
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

$odf = new odf("tutoriel2.odt");

$odf->setVars('titre','Anaska formation');

$message = "Anaska, leader Français de la formation informatique sur les technologies 
Open Source, propose un catalogue de plus de 50 formations dont certaines préparent 
aux certifications Linux, MySQL, PHP et PostgreSQL.";

$odf->setVars('message', $message);

$odf->setImage('image', './images/anaska.jpg');

// We export the file
$odf->exportAsAttachedFile();
 
?>