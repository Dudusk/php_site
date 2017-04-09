<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//Appel du controller
require ('./mvc/controller.php');
//Apel de la view
require ('./mvc/view.php');

//Création controller
$controller = new controller();
$controller->connexion();


//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");

//Appel du contenu (retour)
$contenu = $controller->getContenu();
echo $contenu;

//Appel formulaire de conenxion
$view = new view();
$view->connexion();
 
//Footer
require_once("inc/bas.inc.php"); ?>