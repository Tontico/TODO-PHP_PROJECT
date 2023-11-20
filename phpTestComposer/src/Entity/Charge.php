<?php

namespace Keha\Test\Entity;


class Charge{
    private int $id_charge;
    private string $etat_charge;

    /**
     * Get the value of id_charge
     */ 
    public function getId_charge()
    {
        return $this->id_charge;
    }

    /**
     * Get the value of etat_charge
     */ 
    public function getEtat_charge()
    {
        return $this->etat_charge;
    }
}
