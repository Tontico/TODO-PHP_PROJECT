<?php

namespace Keha\Test\Entity;

class Tache
{
    private int $id_tache;
    private ?string $nom_tache;
    private ?string $descritpion_tache;
    private ?string $date_debut_tache;
    private ?string $date_realisation_tache;
    private ?string $date_butoire_tache;
    private int $id_charge;
    private int $id_priorite;
    private int $id_utilisateur;
    private int $id_projet;
    private int $id_status;

    public function __construct($id, $nom, $descritpion, $date_debut, $date_fin, $date_butoire, $idcharge, $idprio, $iduser, $idprojet, $idstatus)
    {
        $this->id_tache = $id;
        $this->nom_tache = $nom;
        $this->descritpion_tache = $descritpion;
        $this->date_debut_tache = $date_debut;
        $this->date_realisation_tache = $date_butoire;
        $this->date_realisation_tache = $date_fin;
        $this->id_charge = $idcharge;
        $this->id_priorite = $idprio;
        $this->id_utilisateur = $iduser;
        $this->id_projet = $idprojet;
        $this->id_status = $idstatus;
    }

    /**
     * Get the value of nom_tache
     */
    public function getNom_tache()
    {
        return $this->nom_tache;
    }

    /**
     * Get the value of descritpion_tache
     */
    public function getDescritpion_tache()
    {
        return $this->descritpion_tache;
    }

    /**
     * Set the value of descritpion_tache
     *
     * @return  self
     */
    public function setDescritpion_tache($descritpion_tache)
    {
        $this->descritpion_tache = $descritpion_tache;

        return $this;
    }

    /**
     * Get the value of date_debut_tache
     */
    public function getDate_debut_tache()
    {
        return $this->date_debut_tache;
    }

    /**
     * Set the value of date_debut_tache
     *
     * @return  self
     */
    public function setDate_debut_tache($date_debut_tache)
    {
        $this->date_debut_tache = $date_debut_tache;

        return $this;
    }

    /**
     * Get the value of date_realisation_tache
     */
    public function getDate_realisation_tache()
    {
        return $this->date_realisation_tache;
    }

    /**
     * Set the value of date_realisation_tache
     *
     * @return  self
     */
    public function setDate_realisation_tache($date_realisation_tache)
    {
        $this->date_realisation_tache = $date_realisation_tache;

        return $this;
    }

    /**
     * Get the value of date_butoire_tache
     */
    public function getDate_butoire_tache()
    {
        return $this->date_butoire_tache;
    }

    /**
     * Set the value of date_butoire_tache
     *
     * @return  self
     */
    public function setDate_butoire_tache($date_butoire_tache)
    {
        $this->date_butoire_tache = $date_butoire_tache;

        return $this;
    }
}
