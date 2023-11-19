<?php

namespace Keha\Test\Entity;

class Projet
{
    private int $id_projet;
    private ?string $titre_projet;
    private ?string $descritpion_projet;
    private ?int $id_administrateur;

    public function __construct($id, $titre, $descritpion, $id_admin)
    {
        $this->id_projet = $id;
        $this->titre_projet = $titre;
        $this->descritpion_projet = $descritpion;
        $this->id_administrateur = $id_admin;
    }
    /**
     * Get the value of id_projet
     */
    public function getId_projet()
    {
        return $this->id_projet;
    }

    /**
     * Get the value of titre_projet
     */
    public function getTitre_projet()
    {
        return $this->titre_projet;
    }

    /**
     * Set the value of titre_projet
     *
     * @return  self
     */
    public function setTitre_projet($titre_projet)
    {
        $this->titre_projet = $titre_projet;

        return $this;
    }

    /**
     * Get the value of descritpion_projet
     */
    public function getDescritpion_projet()
    {
        return $this->descritpion_projet;
    }

    /**
     * Set the value of descritpion_projet
     *
     * @return  self
     */
    public function setDescritpion_projet($descritpion_projet)
    {
        $this->descritpion_projet = $descritpion_projet;

        return $this;
    }

    /**
     * Get the value of id_administrateur
     */
    public function getId_administrateur()
    {
        return $this->id_administrateur;
    }

    /**
     * Set the value of id_administrateur
     *
     * @return  self
     */
    public function setId_administrateur($id_administrateur)
    {
        $this->id_administrateur = $id_administrateur;

        return $this;
    }
}
