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
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        // Var to change the projects colors
        // var_dump($userTasks[0]->getNom_tache());
        // var_dump($projectAndTasks);
        // var_dump($projectAndTasks[0]->getTitre_projet());
        // $nomTache = $userTasks[0]->getNom_tache();
        $count = 0;
        $colorProject = "blue";
        echo "
        <main>
        <h2 class='title_username'>Bienvenue " . $_SESSION['username'] . "</h2>
            <section class='resum_container'>
                <div class='resum_container_part'>
                <div class='row'>
                    <h3>Mes tâches</h3>";
        foreach ($projectAndTasks as $projectAndTask) {
            echo $projectAndTask->Nom_tache;
            echo $projectAndTask->getTitre_projet();
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
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormProject') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img src='public/assets/projects/icon_modify.png' alt='logo' style='width: 20px; height: 20px;'></a>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'ConfirmationDelete') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img src='public/assets/projects/icon_delete.png' alt='logo' style='width: 20px; height: 20px;'></a>";
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
            if(($project->getAdministrateur()[0]->getId_utilisateur()) !== ($_SESSION['userId'])){
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
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormProject') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img src='public/assets/projects/icon_modify.png' alt='logo' style='width: 20px; height: 20px;'></a>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'ConfirmationDelete') . "&Id_Projet=" . $project->getId_projet() . "' class='btn'><img src='public/assets/projects/icon_delete.png' alt='logo' style='width: 20px; height: 20px;'></a>";
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
    </body>";
    }


    //Affiche la view avec les différentes taches du projet
    public function displayBodyTaches($task, $project, $participants)
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }
        
        echo "<body>
        <h1>" . $project[0]->getTitre_projet() . "</h1>
        <div class='container-fluid w-100 m-0'>
            <div class='row'>
                <div class='col-2'>";

        // Condition to show or hide link if is administrateur
        if (SecurityController::isAdmin($project[0]->getId_projet())) {
            echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormTask') . "&Id_Projet=" . $project[0]->getId_projet() . "'> Creer une nouvelle Tache</a>;<br>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project[0]->getId_projet() . "&key=1'> Assigner un utilisateur</a><br>";

                    if (isset($_GET["key"])) {
                        echo "<form action='" . UrlGenerator::generateUrl('ProjectController', 'assignUser') . "&Id_Projet=" . $project[0]->getId_projet() . "' method='POST'>
                        <div class='mb-3'>
                            <input type='text' class='form-control' name='mailUser' placeholder='Adresse mail utilisateur' required>
                            </div>
                            <button type='submit' name='submit' class='btn btn-primary'>Assigner</button>
                            </form>";
            }

                      
                    }
                    foreach ($participants as $participant){

                        echo "<h3>".$participant->getUtilisateur()[0]->getNom_utilisateur()."</h3>";
                    }
                    echo  "</div>
            <div class='row col-10'>";

        // a modifier pour ajouter le nom d'utilisateur
        foreach ($task as $key) {
            echo "<div class='col-4'>
            <h2 class=''> " . $key->getNom_tache() . "</h2>";
            if (!empty($key->getUtilisateur()) && ($key->getUtilisateur()[0]) !== NULL) {
                echo "<p class='h5'> Utilisateur en charge de la tache:" . $key->getUtilisateur()[0]->getPrenom_utilisateur() . "</p>";
            } else {
                echo "<p class ='h5'>pas d'utilisateurs assignés</p>";
            }
            if (!empty($key->getPriorite()) && ($key->getPriorite()[0]) !== NULL) {
                echo "<p>Priorite de la tache: " . $key->getPriorite()[0]->getEtat_priorite() . "<p/>";
            } else {
                echo "pas de priorité pour la tache actuellement" . "<br>";
            }

            echo "<p class=''>" . $key->getDescritpion_tache() . "</p>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTache') . "&Id_taches=" . $key->getId_taches() . "'class=''> Lien vers la tache</a>
            </div>";
        }
        echo " </div>    
            </div>
        </div>
        </body>";
    }


    public function displayBodyTache($data)
    {
        if (!SecurityController::isConnected()) {
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion'); // Redirect if not connected
        }


        $data = $data[0];

        //Il faudra ajouter le nom du projet
        echo "<body>
        <h1 class='h1'>" . $data->getProjet()[0]->getTitre_projet() . "</h1>";

        if (!empty($data->getStatus()) && ($data->getStatus()[0]) !== NULL) {
            echo "<p>Statut de la tache: " . $data->getStatus()[0]->getEtat_status() . "<p/>";
        } else {
            echo "pas de statut pour la tache actuellement" . "<br>";
        }
        if (!empty($data->getPriorite()) && ($data->getPriorite()[0]) !== NULL) {
            echo "<p>Priorite de la tache: " . $data->getPriorite()[0]->getEtat_priorite() . "<p/>";
        } else {
            echo "pas de priorité pour la tache actuellement" . "<br>";
        }
        if (!empty($data->getCharge()) && ($data->getCharge()[0]) !== NULL) {
            echo "<p>Charge de la tache: " . $data->getCharge()[0]->getEtat_charge() . "<p/>";
        } else {
            echo "pas de charge pour la tache actuellement" . "<br>";
        }

        // a modifier pour ajouter le nom d'utilisateur, la priorité et le statut de la tache
        echo "<div>
                    <h2 class=''> " . $data->getNom_tache() . "</h2>";
        if (!empty($data->getUtilisateur()) && ($data->getUtilisateur()[0]) !== NULL) {
            echo "<p class='h5'> Utilisateur en charge de la tache:" . $data->getUtilisateur()[0]->getPrenom_utilisateur() . "</p>";
        } else {
            echo "<p class ='h5'>pas d'utilisateurs assignés</p>";
        }
        echo "<p class=''>" . $data->getDescritpion_tache() . "</p>";

        if (($data->getDate_realisation_tache()) === NULL) {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et à finir pour le : " . $data->getDate_butoire_tache() . "</p>";
        } else {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et fini le : " . $data->getDate_realisation_tache() . "</p>";
        }
        // Condition to show or hide link if is administrateur
        if (SecurityController::isAdmin($data->getProjet()[0]->getId_projet())) {
        $idParticipates = Model::getInstance()->getByAttribute('participants_projet', 'Id_Projet', $data->getId_projet());
        echo "<form action='" . UrlGenerator::generateUrl('ProjectController', 'AssignUserTask') . "&Id_taches=" . $_GET['Id_taches'] . "' method='POST'>
                <label for='userName'>user:</label>
                <select class='form-select' name='userName' id='userName'>";

        echo "<option selected>--Please choose an option--</option>";
        foreach ($idParticipates as $idParticipate) {
            echo "<option value='" . $idParticipate->getUtilisateur()[0]->getId_utilisateur() . "'>" . $idParticipate->getUtilisateur()[0]->getPrenom_utilisateur() . "</option>";
        }
        echo "</select>
                <button type='submit' name='submit' class='btn btn-primary mt-3'>Assigner</button>
                </form>";

            echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormTask') . "&Id_projet=" . $data->getProjet()[0]->getId_projet() . "&Id_taches=" . $data->getId_taches() . "' class=''> Modifier la tache</a><br>

            <a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteTask') .  "&Id_taches=" . $data->getId_taches() . "' class=''>Supprimer la tache</a><br>";
        }
        echo "</div>
                </div>
            </div>
        </body>";
        /*<a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>*/
    }


    public function displayProjectConfirmation($data)
    { if (!SecurityController::isConnected()) {
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
