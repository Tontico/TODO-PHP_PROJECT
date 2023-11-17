<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;

class EditeurController extends AbstractController {




    public function displayEditeurs()
    {
        $results = Model::getInstance()->readAll('editeur');
        $this->render('editeurs.php',['editeurs' => $results]);
    }

    public function displayEditeur()
    {
        $result = Model::getInstance()->getById('editeur',111); 
        $this->render('editeur.php',['editeur' => $result]);
    }

    public function createEditeur()
    {
        $datas= [
            'toto'
        ];
        Model::getInstance()->save('editeur',$datas);
    }
}