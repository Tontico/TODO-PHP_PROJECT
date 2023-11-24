<?php

namespace Keha\Test\Controller;

use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\Body;
use Keha\Test\App\Model;


class ProjectController extends AbstractController
{
    public function redirectIndex()
    {
        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
    }
    // Display project if user is connected
    public function displayProjet()
    {

        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        $projectAdmin = Model::getInstance()->getByJoin('Projet', 'Administrateur', 'Id_administrateur', 'Id_administrateur', 'Id_utilisateur', $_SESSION['userId']);
        $projectAndTasks = Model::getInstance()->getByJoin('projet', 'taches', 'Id_projet', 'Id_projet', 'Id_utilisateur', $_SESSION['userId']);
        $projectUser = Model::getInstance()->getProjectByIdUser($_SESSION['userId']);
        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyProject($projectAdmin, $projectUser, $projectAndTasks);
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
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not admin
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

        $titeProject = htmlspecialchars($_POST['Titre_projet'], ENT_QUOTES, 'UTF-8');
        $descriptionProject = htmlspecialchars($_POST["Description_projet"], ENT_QUOTES, 'UTF-8');

        $idAdmin = Model::getInstance()->save('administrateur', $adminInsertData);

        $datas = [
            "Titre_projet" => $titeProject,
            "Description_projet" => $descriptionProject,
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
        $titeProject = htmlspecialchars($_POST['Titre_projet'], ENT_QUOTES, 'UTF-8');
        $descriptionProject = htmlspecialchars($_POST['Description_projet'], ENT_QUOTES, 'UTF-8');
        $datas = [
            'Titre_projet' => $titeProject,
            'Description_projet' => $descriptionProject,
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
        $participants = Model::getInstance()->getByAttribute('participants_projet', 'Id_projet', $_GET["Id_Projet"]);
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
        //current date
        $date = date("Y-m-d");

        $titleTask = htmlspecialchars($_POST['Titre_task'], ENT_QUOTES, 'UTF-8');
        $descriptionTask = htmlspecialchars($_POST["Description_task"], ENT_QUOTES, 'UTF-8');
        $dateTask = htmlspecialchars($_POST["Date_fin"], ENT_QUOTES, 'UTF-8');

        $datas = [
            "Nom_tache" => $titleTask,
            "Descritpion_tache" => $descriptionTask,
            "Date_debut_tache" => $date,
            "Id_projet" => $_GET["Id_Projet"],
        ];
        //if are optionnal if user want to take these data
        if (isset($_POST['Date_fin'])) {
            $datas['Date_butoire_tache'] = $dateTask;
        }
        if (isset($_POST['charge'])) {
            $charge = Model::getInstance()->getByAttribute('charge', 'Etat_charge', htmlspecialchars($_POST['charge'], ENT_QUOTES, 'UTF-8'));
            $datas['Id_charge'] = $charge[0]->getId_charge();
        }
        if (isset($_POST['priorite'])) {
            $priorite = Model::getInstance()->getByAttribute('priorite', 'Etat_priorite', htmlspecialchars($_POST['priorite'], ENT_QUOTES, 'UTF-8'));
            $datas['Id_priorite'] = $priorite[0]->getId_priorite();
        }
        if (isset($_POST['status'])) {
            $status = Model::getInstance()->getByAttribute('status', 'Etat_status', htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8'));
            $datas['Id_status'] = $status[0]->getId_status();
        }

        Model::getInstance()->save('taches', $datas);

        UrlGenerator::redirect('ProjectController', 'displayTaches', '&Id_Projet=', $_GET['Id_Projet']);
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
            "Nom_tache" => htmlspecialchars($_POST["Titre_task"], ENT_QUOTES, 'UTF-8'),
            "Descritpion_tache" => htmlspecialchars($_POST["Description_task"], ENT_QUOTES, 'UTF-8'),
            "Id_projet" => $_GET["Id_Projet"],
        ];

        if (isset($_POST['Date_fin'])) {
            $datas['Date_butoire_tache'] = htmlspecialchars($_POST["Date_fin"], ENT_QUOTES, 'UTF-8');
        }
        if (isset($_POST['charge'])) {
            $charge = Model::getInstance()->getByAttribute('Charge', 'Etat_charge', htmlspecialchars($_POST["charge"], ENT_QUOTES, 'UTF-8'));
            $datas['Id_charge'] = $charge[0]->getId_charge();
        }
        if (isset($_POST['priorite'])) {
            $priorite = Model::getInstance()->getByAttribute('Priorite', 'Etat_priorite', htmlspecialchars($_POST["priorite"], ENT_QUOTES, 'UTF-8'));
            $datas['Id_priorite'] = $priorite[0]->getId_priorite();
        }
        if (isset($_POST['status'])) {
            $status = Model::getInstance()->getByAttribute('status', 'Etat_status',  htmlspecialchars($_POST["status"], ENT_QUOTES, 'UTF-8'));
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
        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET["Id_taches"]);
        if (!SecurityController::isAdmin($task[0]->getId_projet())) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
        }


        //$user = Model::getInstance()->getByAttribute('utilisateur','Id_utilisateur',$_POST['userName']);

        $data = [
            'Id_utilisateur' =>  htmlspecialchars($_POST["userName"], ENT_QUOTES, 'UTF-8'),
        ];
        if (empty($data)) {
        }
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


    public function assignUser()
    {
        $mailUserSanitized = htmlspecialchars($_POST["mailUser"], ENT_QUOTES, 'UTF-8');
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        if (!SecurityController::isAdmin($_GET["Id_Projet"])) {
            UrlGenerator::redirect('ProjectController', 'displayProjet'); // Redirect if not connected
        }

        $user = Model::getInstance()->getByAttribute("utilisateur", "Email_utilisateur", $mailUserSanitized);

        if (empty($user)) {
            UrlGenerator::redirect('UserController', 'DisplayForm', 'inscription');
        }

        $projectId = $_GET['Id_Projet'];
        $userId = $user[0]->getId_utilisateur();
        $userfound = false;
        // Check if the entry already exists
        $existingEntry = Model::getInstance()->getByAttribute('participants_projet', 'Id_projet', $projectId);
        foreach ($existingEntry as $entry) {
            if ($userId === $entry->getId_utilisateur()) {
                $userfound = true;
            }
        }
        if ($userfound === false) {
            // User hasn't be tag on the project
            $data = [
                'Id_projet' => $projectId,
                'Id_utilisateur' => $userId,
            ];
            Model::getInstance()->save("participants_projet", $data);
        }
        // Redirect to project display
        UrlGenerator::redirect('ProjectController', 'displayTaches', "&Id_Projet=", $projectId);
    }
}
