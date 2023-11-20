<?php 

namespace Keha\Test\Entity;

class Participant_projet{
    private int $id_projet;
    private int $id_utilisateur;

    /**
     * Get the value of id_projet
     */ 
    public function getId_projet()
    {
        return $this->id_projet;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }
}