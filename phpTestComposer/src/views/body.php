<?php

namespace Keha\Test\views;

use Keha\Test\App\UrlGenerator;
use Keha\test\controller\Utilisateur;
use Keha\Test\App\Model;
use Keha\Test\App\Entity\Priorite;

//Class that create the Body
class Body
{
    public function displayBodyProject($projectsAdmin, $projectsUser)
    {
        echo "<body>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-12 mb-3'>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormProject') . "' class='btn btn-primary'>Ajoutez un projet</a>
                </div>
                <h3>Projet dont je suis l'administrateur</h3>";

        foreach ($projectsAdmin as $project) {
            echo "<div class='col-md-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>" . $project->getTitre_projet() . "</h5>
                        <p class='card-text'>" . $project->getDescription_projet() . "</p>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project->getId_projet() . "' class='btn btn-primary'>Lien vers le projet</a>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'ConfirmationDelete') . "&Id_Projet=" . $project->getId_projet() ."' class='btn btn-danger'>Supprimez le projet</a>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormProject') . "&Id_Projet=" . $project->getId_projet() ."' class='btn btn-success mt-1'>Modifiez le projet</a>
                    </div>
                </div>
            </div>";
        }
        echo "<h3>Projet dont je suis un utilisateur</h3>";
        foreach ($projectsUser as $project) {
            echo "<div class='col-md-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>" . $project->getTitre_projet() . "</h5>
                        <p class='card-text'>" . $project->getDescription_projet() . "</p>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_Projet=" . $project->getId_projet() . "' class='btn btn-primary'>Lien vers le projet</a>
                        <a href='' class='btn btn-danger'>Supprimez le projet</a>
                    </div>
                </div>
            </div>";
        }

        echo "</div>
            </div>
    </body>";
    }


    //Affiche la view avec les différentes taches du projet
    public function displayBodyTaches($task, $project)
    {


        echo "<body>
            <h1>" . $project[0]->getTitre_projet() . "</h1>
            <div class='container-fluid w-100 m-0'>
                <div class='row'>
                    <div class='col-2'>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormTask') . "&Id_Projet=" . $project[0]->getId_projet() . "'> Creer une nouvelle Tache</a>
                    </div>
                <div class='row col-10'>";


        // a modifier pour ajouter le nom d'utilisateur
        foreach ($task as $data => $key) {
            echo "<div class='col-4'>
            <h2 class=''> " . $key->getNom_tache() . "</h2>
            <h3 class='h4'> Utilisateur en charge de la tache:" . /*$key->getUtilisateur()[0]->getNom_utilisateur().*/ "</h3>
            <p class=''>" . $key->getDescritpion_tache() . "</p>
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
        $data = $data[0];
        
        //Il faudra ajouter le nom du projet
        echo "<body>
        <h1>NOM PROJET</h1>";
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
                    <h2 class=''> " . $data->getNom_tache() . "</h2>
                    <h3 class='h4'> Utilisateur en charge de la tache: " ./*($data->getUtilisateur())[0]->getNom_utilisateur().*/ "</h3>
                    <p class=''>" . $data->getDescritpion_tache() . "</p>";

        if (($data->getDate_realisation_tache()) === NULL) {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et à finir pour le : " . $data->getDate_butoire_tache() . "</p>";
        } else {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et fini le : " . $data->getDate_realisation_tache() . "</p>";
        }

        echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'displayUpdateFormTask') . "&Id_projet=" . $data->getProjet()[0]->getId_projet() . "&Id_taches=" . $data->getId_taches() . "' class=''> Modifier la tache</a><br>

            <a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteTache') . "' class=''>Supprimer la tache</a><br>
            </div>


    </div>
        </div>
    </body>";
        /*<a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>*/
    }


    public function displayProjectConfirmation($data)
    {
        $data= $data[0];
        echo "<body>
<h1>Etes vous sur de vouloir supprimer le projet :".$data->getTitre_projet()."?</h1>
<div class='d-flex justify-content-center'> 
<a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteproject') ."&Id_Projet=".$data->getId_projet(). "' class='btn btn-primary p-2 m-3'>Supprimer</a> <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayProjet') . "' class='btn btn-danger p-2 m-3'>Revenir à la page des projets</a><br>
</div>";       



    }
}
