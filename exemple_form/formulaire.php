<?php
//////////////////////////////////////////////////////////////
// Génération d'un courrier ODT sur base d'un formulaire    //
//                                                          // 
// Laurent Lefèvre - http://www.cybermonde.org              //
// 															//
//////////////////////////////////////////////////////////////

// Source : https://github.com/cybermonde/odtphp

// inclure la librairie
require_once('../library/Odf.php');
// modèle de base
$odf = new odf("formulaire_template.odt");
// si rien n'a été posté on propose le formulaire
if (!$_POST) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Formulaire vers ODT</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
	</style>
	</head>
<body>
                <form id="monformulaire" method="POST" action="formulaire.php">
                <p>
                    <input type="radio" id="invite" name="invite" value="Madame" checked />Mme
                    <input type="radio" id="invite" name="invite" value="Monsieur" />M.
                </p>
                <p>
                    <label for="prenom">Prénom :</label> 
                    <input type="text" id="prenom" name="prenom" size="40" value=""/>
                </p>
                <p>
                    <label for="nom">Nom :</label> 
                    <input type="text" id="nom" name="nom" size="40" value=""/>
                </p>
                <p>
                    <label for="total">Total :</label> 
                    <input type="text" id="total" name="total" size="40" value=""/>
                </p>
                <p>
                <input type="submit" name="submit" />
            </p>
        </form>
</body>
</html>
<?php
// sinon on envoie le fichier généré
} else {
// date du jour
$odf->setVars('cyb_date', date("d/m/Y"));
// données du formulaire
$odf->setVars('cyb_invite', $_POST["invite"]);
// gestion des accents via cet artifice html_entity_decode(htmlentities(...
$odf->setVars('cyb_prenom', html_entity_decode(htmlentities($_POST["prenom"],ENT_NOQUOTES, "utf-8")));
$odf->setVars('cyb_nom', html_entity_decode(htmlentities($_POST["nom"],ENT_NOQUOTES, "utf-8")));
$odf->setVars('cyb_total', $_POST["total"]);
// création du fichier
$odf->exportAsAttachedFile();
}
?> 
