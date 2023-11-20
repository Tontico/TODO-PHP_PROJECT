<?php

namespace Keha\Test\Entity;

class Status{
    private int $id_status;
    private string $etat_status;

    /**
     * Get the value of id_status
     */ 
    public function getId_status()
    {
        return $this->id_status;
    }

    /**
     * Get the value of etat_status
     */ 
    public function getEtat_status()
    {
        return $this->etat_status;
    }
}