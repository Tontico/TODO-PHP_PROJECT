<?php

namespace Keha\Test\Controller;

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
        session_start();
        $head = new Head();
        $header = new Header();
        $head->displayHead();
        $header->displayHeader();
        $this->connexionForm->displayConnexionForm();
        var_dump($_SESSION);
    }

    // Method to handle login process
    public function connexion()
    {
        $error = $this->connexionForm->processFormLogin(); // Process the login form
        if ($error === true) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if login ok
            exit;
        } else {
            $this->displayConnexion($error); // Redisplay the login form with error value
        }
    }

    public static function isConnected()
    {
        if (isset($_SESSION['connected'])) {
            return true;
        }
        return false;
    }

    public static function disconnect()
    {
        echo "pdza";
    }
}
