<?php

namespace Keha\Test\views;

use Keha\Test\App\UrlGenerator;
use Keha\Test\App\Model;

//Class that create the Body
class Body
{
    public function displayBodyProject($projects)
    {
        echo "<body>
        <div class='container'>
            <div class='row'>
                <div class='col-12 mb-3'>
                    <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayFormProject') . "' class='btn btn-primary'>Ajoutez un projet</a>
                </div>";

        foreach ($projects as $project) {
            echo "<div class='col-md-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h4 class='card-title'>" . $project->getTitre_projet() . "</h5>
                        <p class='card-text'>" . $project->getDescription_projet() . "</p>
                        <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "&Id_projet=" . $project->getId_projet() . "' class='btn btn-primary'>Lien vers le projet</a>
                        <a href='' class='btn btn-danger'>Supprimez le projet</a>
                    </div>
                </div>
            </div>";
        }

        echo "</div>
            </div>
    </body>";
    }


    public function displayBodyTaches($datas)
    {
        //Il faudra ajouter le nom du projet
        echo "<body>
<h1>NOM PROJET</h1>
        <div class='container-fluid w-100 m-0'>
            <div class='row'>;
            <div class='col-2'>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'createTache') . "&Id_projet=" . $datas[0]->getId_projet() . "' class=''> Creer une nouvelle Tache</a>
            </div>
            <div class='row col-10'>";


        // a modifier pour ajouter le nom d'utilisateur
        foreach ($datas as $data => $key) {
            echo "<div class='col-4'>
            <h2 class=''> " . $key->getNom_tache() . "</h2>
            <h3 class='h4'> Utilisateur en charge de la tache: Moi</h3>
            <p class=''>" . $key->getDescritpion_tache() . "</p>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTache') . "' class=''> Lien vers la tache</a>
            </div>";
        }

        echo " </div>    
</div>
        </div>
    </body>";
    }

    public function displayBodyTache($data)
    {
        //Il faudra ajouter le nom du projet
        echo "<body>
        <h1>NOM PROJET</h1>";


        // a modifier pour ajouter le nom d'utilisateur, la priorité et le statut de la tache
        echo "<div>
            <h2 class=''> " . $data->getNom_tache() . "</h2>
            <p>Priorité taches, et statut tache<p/>
            <h3 class='h4'> Utilisateur en charge de la tache: Moi</h3>
            <p class=''>" . $data->getDescritpion_tache() . "</p>";

        if (($data->getDate_realisation_tache()) === NULL) {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et à finir pour le : " . $data->getDate_butoire_tache() . "</p>";
        } else {
            echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache() . " et fini le : " . $data->getDate_realisation_tache() . "</p>";
        }

        echo "<a href='" . UrlGenerator::generateUrl('ProjectController', 'modifyTache') . "' class=''> Modifier la tache</a><br>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'deleteTache') . "' class=''>Supprimer la tache</a><br>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'updateStatusTache') . "' class=''>Modifier le statut de la tache</a>
            </div>


</div>
        </div>
    </body>";
    }
}
