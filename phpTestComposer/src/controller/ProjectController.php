<?php

namespace Keha\Test\Controller;

use Keha\Test\Entity\Projet;
use Keha\Test\Entity\Taches;
use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\Body;
use Keha\Test\app\Model;

class ProjectController extends AbstractController
{

    // Display project if user is connected
    public function displayProjet()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        /*$data[1] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[2] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[3] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);*/
        $projects = Model::getInstance()->getProjectByIdUser($_SESSION['userId']);

        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyProject($projects);
    }


    // Display all tache if user is connected
    public function displayTaches()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        // $data[0] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data[1] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data[2] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data[3] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data[4] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data[5] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);

        $task = Model::getInstance()->getByAttribute('taches', 'Id_projet', $_GET["Id_Projet"]);
        $project = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET["Id_Projet"]);


        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTaches($task, $project);
    }
    //Display one tache if user is connected
    public function displayTache()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
   


        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);

        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($task);
    }
    public function ConfirmationDelete()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }
        $projects = Model::getInstance()->getByAttribute('Projet', 'Id_projet', $_SESSION['userId']);
        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayProjectConfirmation($projects);
    }
    public function deleteproject()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
   


        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);

        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($task);
    }


}
