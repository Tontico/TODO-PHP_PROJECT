<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;
use Keha\Test\App\UrlGenerator;

class FormController extends AbstractController
{
    public $error;

    public function __construct()
    {
        $this->error = false;
    }
    //section ProjectForm
    public function constructProjectForm()
    {
        echo "<main class='main_project'>
            <div class='update_form_container'>

                <form id='project_form' action='" . UrlGenerator::generateUrl('ProjectController', 'createProject') . "' method='POST'>
                    <div class='mb-3'>
                        <label for='Titre_projet' class='form-label' >Nom du projet</label>
                        <input type='text' class='form-control'  placeholder='Titre du projet' name='Titre_projet' required>
                    </div>

                    <div class='mb-3'>
                        <label for='Description_projet' class='form-label'>Description</label>
                        <textarea class='form-control inputDescription' placeholder='Description du projet' name='Description_projet' required></textarea>
                    </div>

                    <button type='submit' name='submit' class='btn btn-primary'>Créer un projet</button>
                </form>
            </div>
        </main>";

        if (isset($_POST["submit"])) {
            return UrlGenerator::redirect('ProjectController', 'displayProjet');
        }
    }
    public function updateProjectForm()
    {

        $updateProject = Model::getInstance()->getByAttribute('projet', 'Id_projet', $_GET['Id_Projet']);
        echo "<main class='main_project'>
            <div class='update_form_container'>
                <form  id= 'project_form' action='" . UrlGenerator::generateUrl('ProjectController', 'updateProject') . "&Id_Projet=" . $updateProject[0]->getId_projet() . "' method='POST'>
                    
                    <div class='mb-3'>
                        <label for='Titre_projet' class='form-label'>Nom du projet</label>
                        <input type='text' class='form-control' name='Titre_projet' value='" . $updateProject[0]->getTitre_projet() . "' required>
                    </div>

                    <div class='mb-3'>
                        <label for='Description_projet' class='form-label'>Description</label>
                        <textarea class='form-control inputDescription' name='Description_projet' required>" . $updateProject[0]->getDescription_projet() . "</textarea>
                    </div>

                    <button type='submit' name='submit' class='btn btn-primary'>Modifier le projet</button>
                </form>
            </div>
        </main>";

        if (isset($_POST["submit"])) {
            return UrlGenerator::redirect('ProjectController', 'displayProjet');
        }
    }

    //section Task
    public function constructTaskForm()
    {
        echo "<main class='main_project'>
            <div class='update_form_container'>
                <form id='project_form' action='" . UrlGenerator::generateUrl('ProjectController', 'createTask') . "&Id_Projet=" . $_GET['Id_Projet'] . "' method='POST'>
                    <div class='mb-3'>
                        <label for='Titre_task' class='form-label'>Nom de la tâche*</label>
                        <input type='text' class='form-control' name='Titre_task' required>
                    </div>

                    <div class='mb-3'>
                        <label for='Description_task' class='form-label'>Description de la tâche*</label>
                        <input type='text' class='form-control' name='Description_task' required>
                    </div>

                    <div class='mb-3'>
                        <label for='Date_fin' class='form-label'>Date butoire de la tâche</label>
                        <input type='date' class='form-control' name='Date_fin' id='date_fin'>
                    </div>
                    <div class='radioStateAndPriority'>
                        <div class='mb-3'>
                            <h6>Sélectionnez l'état de la charge :</h6>
                            <div>
                                <input type='radio' name='charge' value='Légère'/>
                                <label for='Légère'>Légère</label>
                            </div>

                            <div>
                                <input type='radio' name='charge' value='Modérée'/>
                                <label for='Modérée'>Modérée</label>
                            </div>

                            <div>
                                <input type='radio' name='charge' value='Élevée'/>
                                <label for='Élevée'>Élevée</label>
                            </div>
                        </div>

                        <div class='mb-3'>
                            <h6>Sélectionnez la priorité de la tâche :</h6>
                            <div>
                                <input type='radio' name='priorite' value='Basse'/>
                                <label for='Basse'>Basse</label>
                            </div>

                            <div>
                                <input type='radio' name='priorite' value='Moyenne'/>
                                <label for='Moyenne'>Moyenne</label>
                            </div>

                            <div>
                                <input type='radio' name='priorite' value='Haute'/>
                                <label for='Haute'>Haute</label>
                            </div>
                        </div>
                    </div>

                    <div class='mb-3'>
                        <h6>Sélectionnez le statut de la tâche :</h6>
                        <div>
                            <input type='radio' name='status' value='Non débuté' />
                            <label for='Non débuté'>Non débuté</label>
                        </div>

                        <div>
                            <input type='radio' name='status' value='En cours'/>
                            <label for='En cours'>En cours</label>
                        </div>

                        <div>
                            <input type='radio' name='status' value='Terminé'/>
                            <label for='Terminé'>Terminé</label>
                        </div>
                    </div>

                    <button type='submit' name='submit' class='btn btn-primary'>Créer une tâche</button>
                </form>
            </div>
        </main>";

        if (isset($_POST["submit"])) {
            return UrlGenerator::redirect('ProjectController', 'displayTask');
        }
    }

    public function updateTaskForm()
    {
        $task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET['Id_taches']);
        echo "<main class='main_project'>
            <div class='update_form_container'>
            <form id='project_form' action='" . UrlGenerator::generateUrl('ProjectController', 'updateTask') . "&Id_Projet=" . $task[0]->getProjet()[0]->getId_projet() . "&Id_taches=" . $task[0]->getId_taches() . "' method='POST'>
                <div class='mb-3'>
                    <label for='Titre_task' class='form-label'>Nom de la tâche*</label>
                    <input type='text' class='form-control' name='Titre_task' value='" . $task[0]->getNom_tache() . "' required>
                </div>
        
                <div class='mb-3'>
                    <label for='Description_task' class='form-label'>Description de la tâche*</label>
                    <input type='text' class='form-control' name='Description_task' value='" . $task[0]->getDescritpion_tache() . "' required>
                </div>
        
                <div class='mb-3'>
                    <label for='Date_fin' class='form-label'>Date butoire de la tâche</label>
                    <input type='date' class='form-control' name='Date_fin' value='" . $task[0]->getDate_butoire_tache() . "' id='date_fin'>
                </div>
                
                <div class='radioStateAndPriority'>
                <div class='mb-3'>
                <h6>Sélectionnez l'état de la charge :</h6>";
        $chargeOptions = ['Légère', 'Modérée', 'Élevée'];

        foreach ($chargeOptions as $option) {
            echo "<div>
                <input type='radio' name='charge' value='$option'" . (isset($task[0]->getCharge()[0]) && $task[0]->getCharge()[0]->getEtat_charge() === $option ? 'checked' : '') . "/>
                <label for='$option'>$option</label>
            </div>";
        }

        echo "</div>
                <div class='mb-3'>
                <h6>Sélectionnez la priorité de la tâche :</h6>";
        $prioriteOptions = ['Basse', 'Moyenne', 'Haute'];

        foreach ($prioriteOptions as $option) {
            echo "<div>
                <input type='radio' name='priorite' value='$option'" . (isset($task[0]->getPriorite()[0]) && $task[0]->getPriorite()[0]->getEtat_priorite() === $option ? 'checked' : '') . "/>
                <label for='$option'>$option</label>
            </div>";
        }


        echo "</div>
                <div class='mb-3'>
                <h6>Sélectionnez le statut de la tâche :</h6>";
        $statusOptions = ['Non débuté', 'En cours', 'Terminé'];

        foreach ($statusOptions as $option) {
            echo "<div>
                <input type='radio' name='status' value='$option'" . (isset($task[0]->getStatus()[0]) && $task[0]->getStatus()[0]->getEtat_status() === $option ? 'checked' : '') . "/>
                <label for='$option'>$option</label>
            </div>";
        }

        echo "</div>
        </div>
        <button type='submit' name='submit' class='btn btn-primary'>Mettre à jour la tâche</button>
        </form>
        </div>
    </main>";

        if (isset($_POST["submit"])) {
            return UrlGenerator::redirect('ProjectController', 'displayTask');
        }
    }
}
