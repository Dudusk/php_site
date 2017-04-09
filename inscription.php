<?php
//Init
require_once("inc/init.inc.php");
//Header
require_once("inc/haut.inc.php");

//Appel du controller
require ('./mvc/controller.php');
//Apel de la view
require ('./mvc/view.php');

//Création controller
$controller = new controller();
$controller->inscription();

//Appel du contenu
$contenu = $controller->getContenu();
echo $contenu;

//Appel du formulaire d'inscription
$view = new view();
$view->inscription();

//Appel du footer
require_once("inc/bas.inc.php"); ?>