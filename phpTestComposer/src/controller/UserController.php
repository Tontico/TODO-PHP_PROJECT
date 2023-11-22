<?php

namespace Keha\Test\Controller;

use Keha\Test\App\Model;
use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\Model\QueryParser;

class UserController extends AbstractController
{
    private $form;
    private $formName;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // Call the method to check the formName in the query if there is one
        $this->formName = QueryParser::getFormName();
        if ($this->formName !== null) {
            // Construct the class & method name
            $className = "$this->formName" . "Form";
        }

        // Import the class
        $className = "Keha\\Test\\views\\forms\\$this->formName" . "Form";
        // Create a dynamical instance
        $this->form = new $className();
    }

    // Method to display connection form
    public function displayForm()
    {
        $methodName = "display" .  ucfirst(strtolower("$this->formName")) . "Form";
        $head = new Head();
        $header = new Header();
        $head->displayHead();
        $header->displayHeader();
        $this->form->$methodName();
    }

    // Method to handle registration process
    public function handleSubmit()
    {
        // Error is used to stock errors DATA AND user's datas if no error
        $error = $this->form->processForm(); // Process the registration form
        $inputValues = $error[1];
        if (isset($error[0]) && $error[0] === true) {
            // If form is inscription, save user in DB
            if ($this->formName === "inscription") {
                $this->createUser($error[1]);
            }
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if login ok
            exit;
        } else {
            $this->displayForm($error, $inputValues); // Redisplay the login form with error value
        }
    }

    // Method to create the user in DB
    public function createUser($dataForms)
    {
        $datas = [
            "Nom_utilisateur" => $dataForms['lastname'],
            "Prenom_utilisateur" => $dataForms['firstname'],
            "Mdp_utilisateur" => $dataForms['password'],
            "Email_utilisateur" => $dataForms['email'],
        ];

        Model::getInstance()->save('utilisateur', $datas);
    }
}
