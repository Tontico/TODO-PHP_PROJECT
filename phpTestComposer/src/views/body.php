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
        <div class='container'>
            <div class='row'>";


        // a modifier pour ajouter le nom d'utilisateur
        foreach ($datas as $data => $key) {
            echo "<div class='col-4'>
            <h2 class=''> " . $key->getNom_tache() . "</h2>
            <h3 class='h4'> Utilisateur en charge de la tache: Moi</h3>
            <p class=''>" . $key->getDescritpion_tache() . "</p>
            <a href='" . UrlGenerator::generateUrl('ProjectController', 'displayTache') . "' class=''> Lien vers la tache</a>
            </div>";
        }

        echo "     
</div>
        </div>
    </body>";
    }
}
