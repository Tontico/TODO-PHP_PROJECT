<?php

namespace Keha\Test\Controller;

use Keha\Test\Entity\Projet;
use Keha\Test\Entity\Taches;
use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\Body;
use Keha\Test\App\Model;
use Keha\Test\views\forms\ProjectForm;

class ProjectController extends AbstractController
{

    // Display project if user is connected
    public function displayProjet()
    {
        echo "p";
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        /*$data[1] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[2] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[3] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);*/
        $projectAdmin = Model::getInstance()->getByJoin('Projet', 'Administrateur', 'Id_administrateur', 'Id_administrateur', 'Id_utilisateur', $_SESSION['userId']);

        $projectUser = Model::getInstance()->getProjectByIdUser($_SESSION['userId']);

        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyProject($projectAdmin, $projectUser);
    }
    public function displayFormProject()
    {

        $head = new Head();
        $header = new Header();
        $form = new FormController();
        $head->displayHead();
        $header->displayHeader();
        $form->constructProjectForm();
        /*if (isset($_POST['submit']))
        {
        $this->createProject();
        }*/
    }

    public function createProject()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        //$idAdmin = Model::getInstance()->getByAttribute('Administrateur', 'Id_administrateur', $_SESSION['userId']);
        //if (!empty($idAdmin)) {
        // $idAdminArray = $idAdmin[0]->getId_administrateur();

        $userId =  $_SESSION['userId'];

        $adminInsertData = [
            "Id_utilisateur" => $userId,
        ];

        $idAdmin = Model::getInstance()->save('administrateur', $adminInsertData);

        $datas = [
            "Titre_projet" => $_POST["Titre_projet"],
            "Description_projet" => $_POST["Description_projet"],
            "Id_administrateur" => $idAdmin,
        ];

        Model::getInstance()->save('projet', $datas);

        return UrlGenerator::redirect('ProjectController', 'displayProjet');

        //} else {
        //echo "L'administrateur n'a pas été trouvé pour l'utilisateur avec l'ID : {$_SESSION['userId']}";
        //}
    }


    // Display all tache if user is connected
    public function displayTaches()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
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
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTaches($task, $project);
    }
    //Display one tache if user is connected
    public function displayTache()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
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
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
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
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        // $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);



        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        // $priority = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        // $charge = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        // $status = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);

        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($task);
    }
}
