<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;

class AbonneController extends AbstractController {

    public function createAbonne()
    {
        $date=getdate();
        ($date['year']."-".$date['mon']."-".$date['mday']);
        $datas= [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'date_naissance' => $_POST['date_naissance'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'ville' => $_POST['ville'],
            'date_inscription' => ($date['year']."-".$date['mon']."-".$date['mday']),
            'date_fin_abo' => (($date['year']+3)."-".$date['mon']."-".$date['mday']),
        ];
        Model::getInstance()->save('abonne',$datas);
        $this->render('index.php',[]);
    }

    public function deleteAbonne()
    {
        $results = Model::getInstance()->getByAttribute('emprunt', 'id_abonne', $_GET['id']);
        if($results !== NULL){    
            if(isset($_POST['submit'])){
                echo 'coucou';
                Model::getInstance()->delete('emprunt', 'id_abonne', $_GET['id']);
                Model::getInstance()->delete('abonne', 'id', $_GET['id']);
                $this->render('index.php',[]);
                echo 'abonné supprimé';
            } else{
                header('Location: http://localhost/phpobjet/phpTestComposer/index.php?controller=FormController&method=validateDeleteForm&id='.$_GET['id'] );
            }
        } else{
        Model::getInstance()->delete('abonne', 'id', $_GET['id']);
        $this->render('index.php',[]);
        echo 'abonné supprimé';
    }
    }

    public function displayAbonnes()
    {
        $results = Model::getInstance()->readAll('abonne');
        $this->render('abonnes.php',['abonnes' => $results]);
    }

    public function displayAbonne()
    {
        $result = Model::getInstance()->getById('abonne', $_GET['id']);
        $this->render('abonne.php',['abonne' => $result]);
    }

    public function UpdateByIdAbonne()
    {
       $datas =['nom' => $_POST['nom'],
       'prenom' => $_POST['prenom'],
       'adresse' => $_POST['adresse'],
       'ville' => $_POST['ville'],
       'code_postal' => $_POST['code_postal'],
       'date_naissance' => $_POST['date_naissance'],
    
    ];
        Model::getInstance()->updateById('abonne',$_GET['id'], $datas);
        $this->render('index.php',[]);
    }

}