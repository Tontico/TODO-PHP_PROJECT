<?php

namespace Keha\Test\Entity;

class Projet
{
    private int $Id_projet;
    private ?string $Titre_projet;
    private ?string $Description_projet;
    private ?int $Id_administrateur;


    /**
     * Get the value of id_projet
     */
    public function getId_projet()
    {
        return $this->Id_projet;
    }

    /**
     * Get the value of titre_projet
     */
    public function getTitre_projet()
    {
        return $this->Titre_projet;
    }

    /**
     * Set the value of titre_projet
     *
     * @return  self
     */
    public function setTitre_projet($titre_projet)
    {
        $this->Titre_projet = $titre_projet;

        return $this;
    }

    /**
     * Get the value of descritpion_projet
     */
    public function getDescription_projet()
    {
        return $this->Description_projet;
    }

    /**
     * Set the value of descritpion_projet
     *
     * @return  self
     */
    public function setDescritpion_projet($descritpion_projet)
    {
        $this->Description_projet = $descritpion_projet;

        return $this;
    }

    /**
     * Get the value of id_administrateur
     */
    public function getId_administrateur()
    {
        return $this->Id_administrateur;
    }

    /**
     * Set the value of id_administrateur
     *
     * @return  self
     */
    public function setId_administrateur($id_administrateur)
    {
        $this->Id_administrateur = $id_administrateur;

        return $this;
    }
}
