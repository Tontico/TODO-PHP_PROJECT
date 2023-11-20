<?php

namespace Keha\Test\Entity;

class Status{
    private int $Id_status;
    private string $Etat_status;

    /**
     * Get the value of id_status
     */ 
    public function getId_status()
    {
        return $this->Id_status;
    }

    /**
     * Get the value of etat_status
     */ 
    public function getEtat_status()
    {
        return $this->Etat_status;
    }
}