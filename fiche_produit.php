<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//

//Appel du controller
require ('./mvc/controller.php');
//Apel de la view
require ('./mvc/view.php');

//Création controller
$controller = new controller();
$controller->fiche_produit();

//--------------------------------- AFFICHAGE HTML ---------------------------------//


require_once("inc/haut.inc.php");

//Appel du contenu
$contenu = $controller->getContenu();
echo $contenu;

require_once("inc/bas.inc.php");


?>