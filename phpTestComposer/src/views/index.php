<?php

namespace Keha\Test\views;

use Keha\Test\Controller\ConnexionController;
use Keha\Test\Controller\IndexController;


$connexionController = new ConnexionController();
$indexController = new IndexController();
$indexController->displayIndex();

echo "dzad";
