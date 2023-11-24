<?php

namespace Keha\Test\Entity;

use Keha\Test\App\Model;

class Taches
{
    private int $Id_taches;
    private ?string $Nom_tache;
    private ?string $Descritpion_tache;
    private ?string $Date_debut_tache;
    private ?string $Date_realisation_tache;
    private ?string $Date_butoire_tache;
    private ?int $Id_charge;
    private ?int $Id_priorite;
    private ?int $Id_utilisateur;
    private ?int $Id_projet;
    private ?int $Id_status;

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

    /**
     * Get the value of Id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->Id_utilisateur;
    }

    /**
     * Set the value of Id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($Id_utilisateur)
    {
        $this->Id_utilisateur = $Id_utilisateur;

        return $this;
    }


    public function getUtilisateur()
    {
        return Model::getInstance()->getByAttribute('utilisateur', 'Id_utilisateur', $this->Id_utilisateur);
    }


    /**
     * Get the value of Id_taches
     */
    public function getId_taches()
    {
        return $this->Id_taches;
    }

    public function getPriorite()
    {
        return Model::getInstance()->getByAttribute('priorite', 'Id_priorite', $this->Id_priorite);
    }

    public function getStatus()
    {
        return Model::getInstance()->getByAttribute('status', 'Id_status', $this->Id_status);
    }

    public function getCharge()
    {
        return Model::getInstance()->getByAttribute('charge', 'Id_charge', $this->Id_charge);
    }

    //Get an object Projet affiliated with this task
    public function getProjet()
    {
        return Model::getInstance()->getByAttribute('projet', 'Id_projet', $this->Id_projet);
    }

    /**
     * Get the value of Id_projet
     */
    public function getId_projet()
    {
        return $this->Id_projet;
    }
}
