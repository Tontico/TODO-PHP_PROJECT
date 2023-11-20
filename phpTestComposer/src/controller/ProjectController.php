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
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        /*$data[1] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[2] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[3] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);*/
        $projects = Model::getInstance()->getByJoin('Projet','Administrateur', 'Id_administrateur','Id_administrateur','Id_utilisateur', $_SESSION['userId']);
    

        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyProject($projects);
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
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }
        //$idAdmin = Model::getInstance()->getByAttribute('Administrateur', 'Id_administrateur', $_SESSION['userId']);
        //if (!empty($idAdmin)) {
        // $idAdminArray = $idAdmin[0]->getId_administrateur();

        $userId = $_SESSION['userId'];

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

        $nameProject = $_POST["Titre_projet"];
        if ($nameProject) {

            return UrlGenerator::redirect('ProjectController', 'displayProjet');
        }
        //} else {
        //echo "L'administrateur n'a pas été trouvé pour l'utilisateur avec l'ID : {$_SESSION['userId']}";
        //}
    }

    // Display tache if user is connected
    public function displayTaches()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        $data[0] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[1] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[2] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[3] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[4] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[5] = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);




        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($data);
    }

    public function displayTache()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        $data = new Taches(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);





        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($data);
    }
}
