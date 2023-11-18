<!-- Create the connexion view -->
<html>
<?php

use Keha\Test\Controller\ConnexionController;

//Create the instance of ConnexionController
$controller = new ConnexionController();
//Call the index Method
$controller->displayConnexion();
