<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;

class LivreController extends AbstractController {


    public function displayLivres()
    {
        $results = Model::getInstance()->readAll('Livre');
        $this->render('livres.php',['livres' => $results]);
    }

    public function displayLivreAuteurEditeur()
    {
        $result = Model::getInstance()->getById('Livre',$_GET['id']);
        $resultEditeur = Model::getInstance()->getById('editeur',$_GET['idEditeur']);
        $resultAuteur = Model::getInstance()->getById('auteur',$_GET['idAuteur']);   
        $this->render('livre.php',['livre' => $result, 'editeur'=>$resultEditeur, 'auteur'=> $resultAuteur ]);
    }

    public function displayLivreEditeur()
    {
        $results = Model::getInstance()->getLivreByIdEditeur('Livre',$_GET['idEditeur']);
        $resultEditeur = Model::getInstance()->getById('editeur',$_GET['idEditeur']);   
        $this->render('livreEditeur.php',['livres' => $results, 'editeur'=>$resultEditeur ]);
    }

    public function displayLivreAuteur()
    {
        $results = Model::getInstance()->getByIdAuteur('livre',$_GET['idAuteur']);
        $resultAuteur = Model::getInstance()->getById('auteur',$_GET['idAuteur']);   
        $this->render('livreAuteur.php',['livres' => $results, 'auteur'=>$resultAuteur ]);
    }

    public function createLivre()
    {
        
        $datas= [
            'titre' => $_POST['titre'],
            'genre' => $_POST['genre'],
            'categorie' => $_POST['categorie'],
            'id_auteur' => $_POST['id_auteur'],
            'id_editeur' => $_POST['id_editeur'],
        ];
        Model::getInstance()->save('livre',$datas);
        $this->render('index.php',[]);
    }

    public function UpdateByIdAbonne()
    {
        $datas= [
            'titre' => $_POST['titre'],
            'genre' => $_POST['genre'],
            'categorie' => $_POST['categorie'],
            'id_auteur' => $_POST['id_auteur'],
            'id_editeur' => $_POST['id_editeur'],
        ];
    
        Model::getInstance()->updateById('livre',$_GET['id'], $datas);
        $this->render('index.php',[]);
    }
}