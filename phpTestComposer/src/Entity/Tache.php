<?php

namespace Keha\Test\Entity;

class Tache
{
    private int $id_tache;
    private ?string $Nom_tache;
    private ?string $Descritpion_tache;
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
        $this->Nom_tache = $nom;
        $this->Descritpion_tache = $descritpion;
        $this->date_debut_tache = $date_debut;
        $this->date_butoire_tache = $date_butoire;
        $this->date_realisation_tache = $date_fin;
        $this->id_charge = $idcharge;
        $this->id_priorite = $idprio;
        $this->id_utilisateur = $iduser;
        $this->id_projet = $idprojet;
        $this->id_status = $idstatus;
    }

    /**
     * Get the value of Nom_tache
     */
    public function getNom_tache()
    {
        return $this->Nom_tache;
    }

    /**
     * Get the value of Descritpion_tache
     */
    public function getDescritpion_tache()
    {
        return $this->Descritpion_tache;
    }

    /**
     * Set the value of Descritpion_tache
     *
     * @return  self
     */
    public function setDescritpion_tache($Descritpion_tache)
    {
        $this->Descritpion_tache = $Descritpion_tache;

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
