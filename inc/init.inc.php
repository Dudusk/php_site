<?php
//--------- BDD
$mysqli = new mysqli("localhost", "root", "root", "site");
//$mysqli->set_charset("utf8");
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);
// $mysqli->set_charset("utf8");
 
//--------- SESSION => Permet de garder la co
session_start();

//--------- CHEMIN
define("RACINE_SITE","/SitePhp/");
 
//--------- VARIABLES
$contenu = '';
 
//--------- AUTRES INCLUSIONS
require_once("fonction.inc.php");