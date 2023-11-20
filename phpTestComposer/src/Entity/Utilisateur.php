<?php

namespace Keha\Test\Entity;

class Utilisateur {
    private int $Id_utilisateur;
    private string $Nom_utilisateur;
    private string $Prenom_utilisateur;
    private string $Mdp_utilisateur;
    private string $Email_utilisateur;

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->Id_utilisateur;
    }

    /**
     * Get the value of nom_utilisateur
     */ 
    public function getNom_utilisateur()
    {
        return $this->Nom_utilisateur;
    }

    /**
     * Get the value of prenom_utilisateur
     */ 
    public function getPrenom_utilisateur()
    {
        return $this->Prenom_utilisateur;
    }

    /**
     * Get the value of mdp_utilisateur
     */ 
    public function getMdp_utilisateur()
    {
        return $this->Mdp_utilisateur;
    }

    /**
     * Get the value of email_utilisateur
     */ 
    public function getEmail_utilisateur()
    {
        return $this->Email_utilisateur;
    }
}