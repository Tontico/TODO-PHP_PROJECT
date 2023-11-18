<!-- Create the index view -->
<html>
<?php

use Keha\Test\Controller\IndexController;

//Create the instance of IndexController
$controller = new IndexController();
//Call the index Method
$controller->displayIndex();
