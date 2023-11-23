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
use Keha\Test\Entity\Participants_projet;
use Keha\Test\Entity\Utilisateur;

class ProjectController extends AbstractController
{

    // Display project if user is connected
    public function displayProjet()
    {

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
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        $head = new Head();
        $header = new Header();
        $form = new FormController();
        $head->displayHead();
        $header->displayHeader();
        $form->constructProjectForm();
    }

    public function displayUpdateFormProject()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
        //  UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not admin
        }
        
        $head = new Head();
        $header = new Header();
        $form = new FormController();
        $head->displayHead();
        $header->displayHeader();
        $form->updateProjectForm();
    }

    public function displayFormTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        // Redirect user if isn't admin of the project
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }
        $head = new Head();
        $header = new Header();
        $form = new FormController();
        $head->displayHead();
        $header->displayHeader();
        $form->constructTaskForm();
    }
    public function displayUpdateFormTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        // Redirect user if isn't admin of the project
        if (!SecurityController::isAdmin($_GET["Id_projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet');
            exit();
        }
        $head = new Head();
        $header = new Header();
        $form = new FormController();
        $head->displayHead();
        $header->displayHeader();
        $form->updateTaskForm();
    }

    public function createProject()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

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

        $idProjet = Model::getInstance()->save('projet', $datas);

        $participate = [
            "Id_projet" => $idProjet,
            "id_utilisateur" => $userId,
        ];

        Model::getInstance()->save('participants_projet', $participate);


        UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    public function updateProject()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }

        $project = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET['Id_Projet']);
        var_dump($project);
        $datas = [
            'Titre_projet' => $_POST['Titre_projet'],
            'Description_projet' => $_POST['Description_projet'],
            'Id_administrateur' => $project[0]->getId_administrateur(),
        ];

        Model::getInstance()->updateById('Projet', 'Id_projet', $_GET['Id_Projet'], $datas);

        UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    // Display all tache if user is connected
    public function displayTaches()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        $task = Model::getInstance()->getByAttribute('taches', 'Id_projet', $_GET["Id_Projet"], 'ORDER BY Id_priorite DESC');
        $project = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET["Id_Projet"]);

        $participant = Model::getInstance()->getBy2Attribute('participants_projet', 'Id_utilisateur', $_SESSION["userId"], 'Id_projet', $_GET["Id_Projet"]);
        $participants = Model::getInstance()->getByAttribute('participants_projet','Id_projet', $_GET["Id_Projet"]);
        if (empty($participant)) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect to his own projects
        }

        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTaches($task, $project, $participants);
    }

    //Display one tache if user is connected
    public function displayTache()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }


        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        if (empty($task)) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if task does not exist
        }
        $participant = Model::getInstance()->getBy2Attribute('participants_projet', 'Id_utilisateur', $_SESSION["userId"], 'Id_projet', $task[0]->getId_projet());
        if (empty($participant)) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not affiliated with this projet
        }



        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($task);
    }

    public function createTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }

        $date = date("Y-m-d");

        /*$user = Model::getInstance()->getByAttribute('Utilisateur', 'Nom_utilisateur', $_POST['nom_utilisateur']);

        if (!$user) {

            $userData = [
                "Nom_utilisateur" => $_POST["nom_utilisateur"],
            ];

            $userId = Model::getInstance()->save('Utilisateur', $userData);
        } else {

            $userId = $user[0]->getId_utilisateur();
        }*/

        $datas = [
            "Nom_tache" => $_POST["Titre_task"],
            "Descritpion_tache" => $_POST["Description_task"],
            "Date_debut_tache" => $date,
            "Id_projet" => $_GET["Id_Projet"],
        ];

        if (isset($_POST['Date_fin'])) {
            $datas['Date_butoire_tache'] = $_POST['Date_fin'];
        }
        if (isset($_POST['charge'])) {
            $charge = Model::getInstance()->getByAttribute('charge', 'Etat_charge', $_POST['charge']);
            var_dump($charge);
            $datas['Id_charge'] = $charge[0]->getId_charge();
        }
        if (isset($_POST['priorite'])) {
            $priorite = Model::getInstance()->getByAttribute('priorite', 'Etat_priorite', $_POST['priorite']);
            $datas['Id_priorite'] = $priorite[0]->getId_priorite();
        }
        if (isset($_POST['status'])) {
            $status = Model::getInstance()->getByAttribute('status', 'Etat_status', $_POST['status']);
            $datas['Id_status'] = $status[0]->getId_status();
        }

        Model::getInstance()->save('taches', $datas);

        return UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    public function updateTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }

        $datas = [
            "Nom_tache" => $_POST["Titre_task"],
            "Descritpion_tache" => $_POST["Description_task"],
            "Id_projet" => $_GET["Id_Projet"],
        ];

        if (isset($_POST['Date_fin'])) {
            $datas['Date_butoire_tache'] = $_POST['Date_fin'];
        }
        if (isset($_POST['charge'])) {
            $charge = Model::getInstance()->getByAttribute('Charge', 'Etat_charge', $_POST['charge']);
            $datas['Id_charge'] = $charge[0]->getId_charge();
        }
        if (isset($_POST['priorite'])) {
            $priorite = Model::getInstance()->getByAttribute('Priorite', 'Etat_priorite', $_POST['priorite']);
            $datas['Id_priorite'] = $priorite[0]->getId_priorite();
        }
        if (isset($_POST['status'])) {
            $status = Model::getInstance()->getByAttribute('status', 'Etat_status', $_POST['status']);
            $datas['Id_status'] = $status[0]->getId_status();
        }
        Model::getInstance()->updateById('taches', 'Id_taches', $_GET['Id_taches'], $datas);

        return UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    public function assignUserTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }

        //$user = Model::getInstance()->getByAttribute('utilisateur','Id_utilisateur',$_POST['userName']);
        $data = [
            'Id_utilisateur' => $_POST['userName'],
        ];
        Model::getInstance()->updateById("taches", 'Id_taches', $_GET['Id_taches'], $data);

        UrlGenerator::redirect("ProjectController", "displayProjet");
    }

    public function ConfirmationDelete()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        // Redirect user if isn't admin of the project
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }
        $projects = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET['Id_Projet']);
        var_dump($projects);
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
        // Redirect user if isn't admin of the project
        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
            exit();
        }
        $tasks = Model::getInstance()->getByAttribute('taches', 'Id_projet', $_GET["Id_Projet"]);
        if (!empty($tasks)) {
            foreach ($tasks as $task) {
                Model::getInstance()->delete('taches', 'Id_taches', $task->getId_taches());
            }
        }

        $participants = Model::getInstance()->getByAttribute('participants_projet', 'Id_projet', $_GET["Id_Projet"]);
        if (!empty($participants)) {
            Model::getInstance()->delete('participants_projet', 'Id_projet', $_GET["Id_Projet"]);
        }

        $project = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET["Id_Projet"]);
        if (!empty($project)) {
            Model::getInstance()->delete('projet', 'Id_projet', $_GET["Id_Projet"]);
        }

        $admin = Model::getInstance()->getByAttribute('administrateur', 'Id_administrateur', $project[0]->getId_administrateur());
        if (!empty($admin)) {
            Model::getInstance()->delete('administrateur', 'Id_administrateur', $project[0]->getId_administrateur());
        }

        UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    public function deleteTask()
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        if (!SecurityController::isAdmin($task[0]->getId_projet())) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
        }

        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        var_dump($task);
        if (!empty($task)) {

            Model::getInstance()->delete('taches', 'Id_taches', $_GET["Id_taches"]);
        }


        UrlGenerator::redirect('ProjectController', 'displayProjet');
    }

    public function assignUser(){
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        if (!SecurityController::isAdmin($task[0]->getId_projet())) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
        }

        $user=Model::getInstance()->getByAttribute("utilisateur", "Email_utilisateur", $_POST['mailUser'] );
        if(empty($user)){
            UrlGenerator::redirect('UserController', 'DisplayForm','inscription' );
        }
    $data=[
       'Id_projet' => $_GET['Id_Projet'],
        'Id_utilisateur' => $user[0]->getId_utilisateur(),
        ];

   Model::getInstance()->save("participants_projet", $data);
   //redirection vers les projets
   UrlGenerator::redirect('ProjectController', 'displayProjet');
     }
   
}
