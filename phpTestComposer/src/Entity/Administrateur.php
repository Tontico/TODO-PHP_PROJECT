<?php

namespace Keha\Test\Entity;

class Administrateur{
    private int $id_administrateur;
    private int $id_utilisateur;

    /**
     * Get the value of id_administrateur
     */ 
    public function getId_administrateur()
    {
        return $this->id_administrateur;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }
}
