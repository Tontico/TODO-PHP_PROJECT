<?php

namespace Keha\Test\Entity;


class Charge{
    private int $Id_charge;
    private string $Etat_charge;

    /**
     * Get the value of id_charge
     */ 
    public function getId_charge()
    {
        return $this->Id_charge;
    }

    /**
     * Get the value of etat_charge
     */ 
    public function getEtat_charge()
    {
        return $this->Etat_charge;
    }
}
