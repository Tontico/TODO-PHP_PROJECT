<?php

namespace Keha\Test\Controller;

use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;

class UserController extends AbstractController
{
    private $form;
    private $formName;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        // Call the formName method
        $this->getFormName();
        // Construct the class & method name
        $className = "$this->formName" . "Form";
        // Import the class
        $className = "Keha\\Test\\views\\forms\\$this->formName" . "Form";
        // Create a dynamical instance
        $this->form = new $className();
    }

    private function getFormName()
    {
        // Get the queryStrings values
        $queryString = $_SERVER['QUERY_STRING'];
        // Analyse the str
        parse_str($queryString, $queryArray);
        // Check if the query exist
        if (isset($queryArray['formName'])) {
            // Stock the value of the query method
            $this->formName = $queryArray['formName'];
        }
        if (strpos($this->formName, "display") !== false) {
            // Supprimer "display" tout en conservant le reste du mot
            $this->formName = strtolower(str_replace("display", "", $this->formName));
        }
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
        $error = $this->form->processForm(); // Process the registration form
        if ($error === true) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if login ok
            exit;
        } else {
            $this->displayForm($error); // Redisplay the login form with error value
        }
    }
}
