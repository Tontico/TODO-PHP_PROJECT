<?php 

namespace Keha\Test\Entity;

use Keha\Test\App\Model; 

class Participants_projet{
    private int $Id_projet;
    private int $Id_utilisateur;

    /**
     * Get the value of id_projet
     */ 
    public function getId_projet()
    {
        return $this->Id_projet;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->Id_utilisateur;
    }

    public function getNomUser()
    {
       return Model::getInstance()->getByAttribute('utilisateur','Id_utilisateur', $this->Id_utilisateur);
    }
}