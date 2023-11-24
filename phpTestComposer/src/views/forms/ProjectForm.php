<?php

namespace Keha\Test\views\forms;

use Keha\Test\App\UrlGenerator;

class ProjectForm
{
    public $error;

    public function __construct()
    {
        //$this->datas = $datas;
        $this->error = false;
    }


    public function constructProjectForm()
    {

        "<form action='" . UrlGenerator::generateUrl('ProjectController', 'CreateProject') . "' method='POST'>";

        if ($this->error !== false) {
            echo "<div class='alert alert-danger' role='alert'>$this->error</div>";
        }
        echo "<label for='nom'>Nom du projet </label>
            <input type='text' name='nom' required>

            <label for='description'>Description</label>
            <input type='text' name='prenom' id='prenom' required>

            <button type='submit' name='submit'>
                créer un projet
            </button>
        </form>";

       
    }
}
