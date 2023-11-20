<?php

namespace Keha\Test\views;

use Keha\Test\App\UrlGenerator;

//Class that create the Body
class Body
{
    public function displayBodyProject($datas)
    {

        echo "<body>
        <div class='container'>
            <div class='row'>";

        foreach ($datas as $data => $key) {
            echo "<div class='col-4'>
            <h2 class=''> " . $key->getTitre_projet() . "</h2>
            <p class=''>" . $key->getDescritpion_projet() . "</p>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTaches') . "' class='link'> Lien vers le projet</a>
            </div>";
        }

        echo "     
</div>
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
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'createTache') . "' class=''> Creer une nouvelle Tache</a>
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

            If (($data->getDate_realisation_tache())=== NULL) {
                echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache(). " et à finir pour le : " . $data->getDate_butoire_tache(). "</p>";
            } else {
                echo "<p class=''> Tache commencé le : " . $data->getDate_debut_tache(). " et fini le : " . $data->getDate_realisation_tache(). "</p>";
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
