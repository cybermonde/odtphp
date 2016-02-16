<?php
/**
 * Simple Check file : checking your system about php-zip module
 * The output file checkresult.odt must be readable by an oasis document application as openoffice.org
 * You need PHP 5.2 at least
 * You need Zip Xml Extensions (or PclZip library instead if Zip extension)
 * Encoding : ISO-8859-1
 *
 * @copyright  GPL License 2008 - Julien Pauli - Cyril PIERRE de GEYER - Anaska (http://www.anaska.com)
 * @license    http://www.gnu.org/copyleft/gpl.html  GPL License
 * SVN Revision - $Rev: 36 $
 * Last commit by $Author: neveldo $
 * Date - $Date: 2009-06-04 15:45:12 +0200 (jeu., 04 juin 2009) $
 * SVN Revision - $Rev: 36 $
 * Id : $Id: simplecheck.php 36 2009-06-04 13:45:12Z neveldo $
 */

	//  instantiate the Exception class
	class OdfException extends Exception{}

	// checking php-zip module

	if ( !class_exists('ZipArchive') )
	{
	  throw new OdfException('ZipArchive extension not loaded - check your php settings, PHP5.2 minimum with php-zip extension is required');
	}

	// checking php-xml module

	if ( !class_exists('DOMDocument') )
	{
	  throw new OdfException('DOMDocument extension not loaded - check your php settings, PHP5.2 minimum with php-xml extension is required');
	}

	// start code ...

	$filename = "simplecheck.odt"; // must exist in same path as this script

	// load the oasis document via php-lib library

	$file = new ZipArchive();
	if ( $file->open($filename) !== true )
	{
	  throw new OdfException("Error while Opening the file '$filename' - Check your odt file");
	}

	// read content.xml from the oasis document

	if (($contentXml = $file->getFromName('content.xml')) === false)
	{
	  throw new OdfException("Nothing to parse - check that the content.xml file is correctly formed");
	}

	// close the original oasis document

	$file->close();

	// for futur use, with load content.xml via DOMDocument library :

	$odt_content = new DOMDocument('1.0', 'utf-8');
	if ($odt_content->loadXML( $contentXml ) == FALSE)
	{
	  throw new OdfException('Unable to load content.xml by DOMDocument library ', __METHOD__);
	}

	// here, we dont use the temp function but local temporary file
	    
	$tmpfile = md5(uniqid()).'.odt';
	if( !@copy($filename, $tmpfile) );
	{
	    // we do not test, because sometime it return false anyway !!
	    // $errors = error_get_last();
	    // throw new OdfException("Can not copy the tempfile in $tmpfile :[".$errors['message'] ."]/[".$errors['type']."]");        
	}

	// futur use here : $odt_content modifications ...




	// open the temporary zipfile

	if( $file->open($tmpfile, ZIPARCHIVE::CREATE) != TRUE )
	{
	  @unlink($tmpfile); // erase temporary file
	  throw new OdfException("Error while Opening the tempfile '$tmpfile' - Check your odt file");
	}

	// for futur use here : with overwrite content.xml in zip file via DOMDocument library :

	if (! $file->addFromString('content.xml', $odt_content->saveXML()) )
	{
		 @unlink($tmpfile); // erase temporary file
	    throw new OdfException('Error during file export');
	}
        
	// close the temporary zipfile

	$file->close();

	// send the new checkresult.odt file via http :

	$name = "checkresult.odt";
	$size = filesize($tmpfile);
	header('Content-type: application/vnd.oasis.opendocument.text');
	header('Content-Disposition: attachment; filename="'.$name.'"');
	header("Content-Length: ".$size); 
	readfile($tmpfile); // output
	@unlink($tmpfile); // erase temporary file
	exit; // be sure nothing else is write after

?>