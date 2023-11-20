<?php

namespace Keha\Test\Controller;

use Keha\Test\Entity\Projet;
use Keha\Test\Entity\Tache;
use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;
use Keha\Test\views\Header;
use Keha\Test\views\Head;
use Keha\Test\views\Body;

class ProjectController extends AbstractController
{

    // Display project if user is connected
    public function displayProjet()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        $data[0] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[1] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[2] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);
        $data[3] = new Projet(1, "Titre Premier projet", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", 1);



        $head = new Head();
        $header = new Header();
        $body = new Body();
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyProject($data);
    }


    // Display tache if user is connected
    public function displayTaches()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        $data[0] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[1] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[2] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[3] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[4] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
        $data[5] = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);




        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTaches($data);
    }

    public function displayTache()
    {
        if (!ConnexionController::isConnected()) {
            UrlGenerator::redirect('IndexController', 'displayIndex'); // Redirect if not connected
        }

        $data = new Tache(1, "Titre Premiere tache", "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, optio?", "01-10-2024", NULL, "01-12-2024", 1, 1, 1, 1, 1, 1);
   




        $head = new Head();
        $header = new Header();
        $body = new Body;
        $head->displayHead();
        $header->displayHeader();
        $body->displayBodyTache($data);
    }
}
