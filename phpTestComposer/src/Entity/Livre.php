<?php

namespace Keha\Test\Entity;

class Livre {
    private int $id;
    private ?string $titre;
    private ?string $genre;
    private ?string $categorie;
    private ?int $id_auteur;
    private ?int $id_editeur;
    private ?int $id_genre;

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