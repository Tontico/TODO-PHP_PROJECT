<?php

namespace Keha\Test\Entity;

class Administrateur{
    private int $Id_administrateur;
    private int $Id_utilisateur;

    /**
     * Get the value of id_administrateur
     */ 
    public function getId_administrateur()
    {
        return $this->Id_administrateur;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->Id_utilisateur;
    }
}
