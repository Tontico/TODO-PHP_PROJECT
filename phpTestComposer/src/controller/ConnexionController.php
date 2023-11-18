<?php

namespace Keha\Test\Controller;

// Import the urlGenerator Method
require_once(__DIR__ . './../App/UrlGenerator.php');

use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\forms\ConnexionForm;

class ConnexionController extends AbstractController
{
    private $connexionForm;

    public function __construct()
    {
        $datas = ['axell' => "pwett"];
        $this->connexionForm = new ConnexionForm($datas); // Create an instance of ConnexionForm
    }

    // Method to display connection form
    public function displayConnexion()
    {
        $head = new Head();
        $header = new Header();
        $head->displayHead();
        $header->displayHeader();
        $this->connexionForm->displayConnexionForm();
    }

    // Method to handle login process
    public function connexion()
    {
        $error = $this->connexionForm->processFormLogin(); // Process the login form
        if ($error === true) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if login ok
        } else {
            $this->displayConnexion($error); // Redisplay the login form with error value
        }
    }
}
