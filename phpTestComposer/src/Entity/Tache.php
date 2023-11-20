<?php

namespace Keha\Test\Entity;

class Tache
{
    private int $Id_tache;
    private ?string $Nom_tache;
    private ?string $Descritpion_tache;
    private ?string $Date_debut_tache;
    private ?string $Date_realisation_tache;
    private ?string $Date_butoire_tache;
    private int $Id_charge;
    private int $Id_priorite;
    private int $Id_utilisateur;
    private int $Id_projet;
    private int $Id_status;

    public function __construct($id, $nom, $descritpion, $date_debut, $date_fin, $date_butoire, $idcharge, $idprio, $iduser, $idprojet, $idstatus)
    {
        $this->Id_tache = $id;
        $this->Nom_tache = $nom;
        $this->Descritpion_tache = $descritpion;
        $this->Date_debut_tache = $date_debut;
        $this->Date_realisation_tache = $date_butoire;
        $this->Date_realisation_tache = $date_fin;
        $this->Id_charge = $idcharge;
        $this->Id_priorite = $idprio;
        $this->Id_utilisateur = $iduser;
        $this->Id_projet = $idprojet;
        $this->Id_status = $idstatus;
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
    public function setDescritpion_tache($descritpion_tache)
    {
        $this->Descritpion_tache = $descritpion_tache;

        return $this;
    }

    /**
     * Get the value of date_debut_tache
     */
    public function getDate_debut_tache()
    {
        return $this->Date_debut_tache;
    }

    /**
     * Set the value of date_debut_tache
     *
     * @return  self
     */
    public function setDate_debut_tache($date_debut_tache)
    {
        $this->Date_debut_tache = $date_debut_tache;

        return $this;
    }

    /**
     * Get the value of date_realisation_tache
     */
    public function getDate_realisation_tache()
    {
        return $this->Date_realisation_tache;
    }

    /**
     * Set the value of date_realisation_tache
     *
     * @return  self
     */
    public function setDate_realisation_tache($date_realisation_tache)
    {
        $this->Date_realisation_tache = $date_realisation_tache;

        return $this;
    }

    /**
     * Get the value of date_butoire_tache
     */
    public function getDate_butoire_tache()
    {
        return $this->Date_butoire_tache;
    }

    /**
     * Set the value of date_butoire_tache
     *
     * @return  self
     */
    public function setDate_butoire_tache($date_butoire_tache)
    {
        $this->Date_butoire_tache = $date_butoire_tache;

        return $this;
    }
}
