<?php

namespace Keha\Test\views;

use Keha\Test\App\UrlGenerator;
use Keha\test\controller\Utilisateur;
use Keha\Test\App\Model;
use Keha\Test\App\Entity\Priorite;
use Keha\Test\Controller\SecurityController;


//Class that create the Body
class Body
{
    public function displayBodyProject($projectsAdmin, $projectsUser, $projectAndTasks)
    {
        $count = 0;
        $colorProject = "blue";
        echo "<body>
            <main class='main_project'>
            <h2 class='title_username'>Bienvenue " . $_SESSION['username'] . "</h2>
                <section class='resum_container'>
                    <div class='resum_container_part'>
                    <div class='row'>
                        <h3>Mes tâches</h3>";
        foreach ($projectAndTasks as $projectAndTask) {
            $taskName = $projectAndTask->Nom_tache;
            $projectName = $projectAndTask->getTitre_projet();
            $projectId = $projectAndTask->getId_projet();
            echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $projectId . "'><div class='line_task'><p>$taskName</p> <p>$projectName</p> </div></a>";
        }
        echo "</div>
                    </div>
                    <div class='resum_container_part'>        
                        <div class='row'>
                            <h3>Projets dont je suis l'administrateur</h3>
                            <div class='col-12 mt-3 mb-4'>
                                <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormProject') . "' class='btn btn-primary'>Créer un projet</a>
                            </div>";
        foreach ($projectsAdmin as $project) {
            if ($count === 0) {
                $colorProject = "blue";
            } else {
                $colorProject = "orange";
            }

            echo "<div class='col-md-4 mb-4'>";
            if ($colorProject === "orange") {
                echo "<div class='card card_orange'>";
            } else {
                echo "<div class='card'>";
            }
            echo "<div class='card_body'>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project->getId_projet() . "' class='btn btn-card-project'><img src='public/assets/projects/project_icon_" . $colorProject . ".jpg' alt='logo' style='width: 50px; height: 50px; border-radius: 5px 0 0 5px;'></a>
                    <h4 class='card-title'>" . ucfirst($project->getTitre_projet()) . "</h4>
                    <div class='card_icon'>";
            if (SecurityController::isAdmin($project->getId_projet())) {
                echo "
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormProject') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img class='revertColor' src='public/assets/projects/icon_modify.png' alt='logo' style='width: 20px; height: 20px;'></a>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'ConfirmationDelete') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img class='revertColor' src='public/assets/projects/icon_delete.png' alt='logo' style='width: 20px; height: 20px;'></a>";
            }
            echo "</div>
                        </div>
                    </div>";
            echo "</div>";
            if ($count === 0) {
                $count = 1;
            } else {
                $count = 0;
            }
        }

        echo "<h3>Projets dont je suis utilisateur</h3>";
        foreach ($projectsUser as $project) {
            if (($project->getAdministrateur()[0]->getId_utilisateur()) !== ($_SESSION['userId'])) {
                if ($count === 0) {
                    $colorProject = "blue";
                } else {
                    $colorProject = "orange";
                }
                echo "<div class='col-md-4 mb-4'>";
                if ($colorProject === "orange") {
                    echo "<div class='card card_orange'>";
                } else {
                    echo "<div class='card'>";
                }
                echo "<div class='card_body'>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project->getId_projet() . "' class='btn btn-card-project'><img src='public/assets/projects/project_icon_" . $colorProject . ".jpg' alt='logo' style='width: 50px; height: 50px; border-radius: 5px 0 0 5px;'></a>
                    <h4 class='card-title'>" . ucfirst($project->getTitre_projet()) . "</h4>
                    <div class='card_icon'>";
                if (SecurityController::isAdmin($project->getId_projet())) {
                    echo "
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormProject') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img class='revertColor' src='public/assets/projects/icon_modify.png' alt='logo' style='width: 20px; height: 20px;'></a>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'ConfirmationDelete') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img class='revertColor' src='public/assets/projects/icon_delete.png' alt='logo' style='width: 20px; height: 20px;'></a>";
                }
                echo "</div>
                        </div>
                    </div>";
                echo "</div>";
                if ($count === 0) {
                    $count = 1;
                } else {
                    $count = 0;
                }
            }
        }
        echo "</div>
                </div>
            </section>
        </main>
    <body>";
    }


    // Affiche la view avec les différentes taches du projet
    public function displayBodyTaches($tasks, $project)
    {
        echo "<body>
            <main>
                <section class='project_tasks'>
                    <div class='projectName'>
                        <div class='projectNameAndIcon'>
                            <img src='public/assets/projects/project_icon_green.jpg' alt='logo' style='width: 50px; height: 50px; border-radius:10px;margin:5px;'>
                            <h2>" . $project[0]->getTitre_projet() . "</h2>
                        </div>";
        // Condition to show or hide link if is administrateur
        if (SecurityController::isAdmin($project[0]->getId_projet())) {
            echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormTask') . "&Id_Projet=" . $project[0]->getId_projet() . "'>
                    <div class='container_createTask'>
                        <p>Créer une tâche</p>
                        <img class='revertColor' src='public/assets/projects/icon_modify.png' alt='logo' style='width: 25px; height: 25px; border-radius:10px;margin:5px;'>
                    </div>
                </a>";
        }
        echo "</div>
                    <div class='projectDescription'>
                        <p>" . $project[0]->getDescription_projet() . "</p>
                    </div>
                    <div class='tasks_container'>
                            <div class='tasks_container_header'>
                            <div class='tasks_container_header_title marginL'><p><strong>Tâches à réaliser</strong></p></div>
                            <div class='tasks_container_header_noTitle'><p><strong>Responsable</strong></p></div>
                            <div class='tasks_container_header_noTitle'><p><strong>Échéance</strong></p></div>
                            <div class='tasks_container_header_noTitle'><p><strong>Priorité</strong></p></div>
                            <div class='tasks_container_header_noTitle'><p><strong>Statut</strong></p></div>
                        </div>
                    </div>";
        foreach ($tasks as $task) {
            echo "<div class='task_container bgGrey'>";
            echo "<div class='tasks_container_header_title marginL'>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTache') . "&Id_taches=" . $task->getId_taches() . "'>
                            <p>" . (!empty($task->getNom_tache()) ? $task->getNom_tache() : "")  . "</p>
                        </a>
                    </div>";
            $utilisateur = $task->getUtilisateur();
            if (!empty($utilisateur) && isset($utilisateur[0])) {
                echo "<div class='tasks_container_header_noTitle'><p>" . (!empty($utilisateur[0]->getNom_utilisateur()) ? $utilisateur[0]->getNom_utilisateur() : "") . " " . (!empty($utilisateur[0]->getPrenom_utilisateur()) ? $utilisateur[0]->getPrenom_utilisateur() : "") . "</p></div>";
            } else {
                echo "<div class='tasks_container_header_noTitle'><p></p></div>";
            }
            $date = $task->getUtilisateur();
            if (!empty($date) && isset($date[0])) {
                echo "<div class='tasks_container_header_noTitle'><p>" . (!empty($task->getDate_butoire_tache()) ? $task->getDate_butoire_tache() : "") . "</p></div>";
            } else {
                echo "<div class='tasks_container_header_noTitle'><p></p></div>";
            }
            $priority = $task->getPriorite();
            if (!empty($priority)) 
             {        $class="";
                if ($priority[0]->getId_priorite()=== 1){
                    $class="class='vert'";
                }
                if ($priority[0]->getId_priorite()=== 2){
                    $class="class='orange'";
                }
                if ($priority[0]->getId_priorite()=== 3){
                    $class="class='rouge'";
                
                }
                echo "<div class='tasks_container_header_noTitle'><p ".$class.">" . (!empty($task->getPriorite()[0]->getEtat_priorite()) ? $task->getPriorite()[0]->getEtat_priorite() : "") . "</p></div>";
           } else {
                echo "<div class='tasks_container_header_noTitle'><p></p></div>";
            }
            $status = $task->getStatus();
            if (!empty($status) && isset($status[0])) {
                echo "<div class='tasks_container_header_noTitle'><p>" . (!empty($task->getStatus()[0]->getEtat_status()) ? $task->getStatus()[0]->getEtat_status() : "") . "</p></div>";
            } else {
                echo "<div class='tasks_container_header_noTitle'><p></p></div>";
            }
            echo  "</div>";
        }
        if (SecurityController::isAdmin($project[0]->getId_projet())) {
            echo "  <a class='btn btn-primary btn-sm' href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project[0]->getId_projet() . "&key=1'> Assigner un utilisateur</a><br>";
            if (isset($_GET["key"])) {
                echo "<form action='" . UrlGenerator::generateUrl('ProjectController', 'assignUser') . "&Id_Projet=" . $project[0]->getId_projet() . "' method='POST'>
                        <div class='mb-3'>
                            <input type='text' class='form-control' name='mailUser' placeholder='Adresse mail utilisateur' required>
                        </div>
                    <button type='submit' name='submit' class='btn btn-primary'>Assigner</button>
                </form>";
            }
        }
        echo "</section>
            </main>
        <body>";
    }


    public function displayBodyTache($data)
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }

        $data = $data[0];

        //Il faudra ajouter le nom du projet
        echo "<body>
            <main class='main_project'>
                <div class='task_form_container'>
                <div class='task_form_body'>
                <div class='titleAndStatus'>
                    <h1 class='h1'>" . ucfirst($data->getNom_tache()) . "</h1><p>" . $data->getProjet()[0]->getTitre_projet() . "</p></div>";

        echo "<div class='metaDataTask'>
            <div class='spaceBetween'>
                <p>";
        if (!empty($data->getStatus()) && ($data->getStatus()[0]) !== NULL) {
            echo "Statut de la tache: " . $data->getStatus()[0]->getEtat_status();
        } else {
            echo "pas de statut pour la tache actuellement" . "<br>";
        }
        echo "</p><p>";
        if (($data->getDate_realisation_tache()) === NULL) {
            echo "Date de fin : " . $data->getDate_butoire_tache();
        } else {
            echo "Fini le : " . $data->getDate_realisation_tache();
        }
        echo "</p></div><div class='spaceBetween'><p>";

        if (!empty($data->getPriorite()) && ($data->getPriorite()[0]) !== NULL) {
            echo "Priorite : " . $data->getPriorite()[0]->getEtat_priorite();
        } else {
            echo "pas de priorité pour la tache actuellement" . "<br>";
        }
        echo "</p><p>";
        if (!empty($data->getCharge()) && ($data->getCharge()[0]) !== NULL) {
            echo "Charge : " . $data->getCharge()[0]->getEtat_charge();
        } else {
            echo "pas de charge pour la tache actuellement" . "<br>";
        }
        // a modifier pour ajouter le nom d'utilisateur, la priorité et le statut de la tache
        echo "</p></div><div><p>";
        if (!empty($data->getUtilisateur()) && ($data->getUtilisateur()[0]) !== NULL) {
            echo "Utilisateur assigné : " . $data->getUtilisateur()[0]->getPrenom_utilisateur();
        } else {
            echo "Pas d'utilisateurs assignés</p>";
        }
        echo "</p>
                </div>
            </div>
        <div class='task_details'>";

        echo "<p class=''> Déscription : <br>" . $data->getDescritpion_tache() . "</p>";
        // if (($data->getDate_realisation_tache()) === NULL) {
        //     echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et à finir pour le : " . $data->getDate_butoire_tache() . "</p>";
        // } else {
        //     echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et fini le : " . $data->getDate_realisation_tache() . "</p>";
        // }
        // Condition to show or hide link if is administrateur
        if (SecurityController::isAdmin($data->getProjet()[0]->getId_projet())) {
            $idParticipates = Model::getInstance()->getByAttribute('participants_projet', 'Id_Projet', $data->getId_projet());
            echo "<form action='" . UrlGenerator::generateUrl('ProjectController', 'AssignUserTask') . "&Id_taches=" . $_GET['Id_taches'] . "' method='POST'>
                            <select class='form-select' name='userName' onchange='checkOption()' id='userName'>";

            echo "<option disabled selected>--Attribuez un utilisateur--</option>";
            foreach ($idParticipates as $idParticipate) {
                echo "<option value='" . $idParticipate->getUtilisateur()[0]->getId_utilisateur() . "'>" . $idParticipate->getUtilisateur()[0]->getPrenom_utilisateur() . "</option>";
            }
            echo "</select>
                            <button type='submit' disabled name='submit' id='submit' class='btn btn-primary mt-3'>Assigner</button>
                            </form>

                            <script>
                                function checkOption(){
                                    let selectElement=document.getElementById('userName');
                                    let selectButton=document.getElementById('submit');

                                    if(selectElement.value !=''){
                                        selectButton.disabled = false;
                                    } else {
                                        selectButton.disabled = true;
                                    }
                                }
                            </script>";
            echo "<div class='spaceBetween'><a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormTask') . "&Id_projet=" . $data->getProjet()[0]->getId_projet() . "&Id_taches=" . $data->getId_taches() . "' class=''> Modifier la tache</a>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteTask') .  "&Id_taches=" . $data->getId_taches() . "' class=''>Supprimer la tache</a>";
        }
        echo "</div>
                        </div>
                    </div>
                </div>
             </main>
        </body>";
        /*<a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>*/
    }



    public function displayProjectConfirmation($data)
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        $data = $data[0];
        echo "<body>
<h1>Etes vous sur de vouloir supprimer le projet :" . $data->getTitre_projet() . "?</h1>
<div class='d-flex justify-content-center'> 
<a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteproject') . "&Id_Projet=" . $data->getId_projet() . "' class='btn btn-primary p-2 m-3'>Supprimer</a> <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayProjet') . "' class='btn btn-danger p-2 m-3'>Revenir à la page des projets</a><br>
</div>";
    }
}
