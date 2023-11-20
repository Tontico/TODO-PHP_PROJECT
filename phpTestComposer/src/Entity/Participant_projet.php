<?php 

namespace Keha\Test\Entity;

class Participant_projet{
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
}