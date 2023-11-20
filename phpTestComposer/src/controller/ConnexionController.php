<?php

namespace Keha\Test\Controller;

use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\forms\ConnexionForm;
use Keha\Test\App\Model;

class ConnexionController extends AbstractController
{
    private $connexionForm;

    public function __construct()
    {
        session_start();
        
        /*$datas = [];
        $datas1 = Model::getInstance()->getByAttribute("utilisateur","Id_utilisateur",1);
        var_dump($datas1);
        $datas[$datas1[0]->getNom_utilisateur()] = $datas1[0]->getMdp_utilisateur();*/
        
        $this->connexionForm = new ConnexionForm(); // Create an instance of ConnexionForm
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

    public static function deconnexion()
    {
        if ($_SESSION['connected']) {
            session_destroy();
            UrlGenerator::redirect('IndexController', 'displayIndex');
        }
    }
}
