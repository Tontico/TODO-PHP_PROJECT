<?php

namespace Keha\Test\Entity;

class Livre {
    private int $Id;
    private ?string $Titre;
    private ?string $Genre;
    private ?string $Categorie;
    private ?int $Id_auteur;
    private ?int $Id_editeur;
    private ?int $Id_genre;

    /**
     * Get the value of nom
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getGenre()
    {
        return $this->genre;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getAuteurId()
    {
        return $this->id_auteur;
    }

    public function getEditeurId()
    {
        return $this->id_editeur;
    }
}