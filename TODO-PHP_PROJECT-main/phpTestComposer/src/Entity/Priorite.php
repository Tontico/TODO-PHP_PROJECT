<?php

namespace Keha\Test\Entity;

class Priorite{
    private int $Id_priorite;
    private string $Etat_priorite;

    /**
     * Get the value of id_priorité
     */ 
    public function getId_priorite()
    {
        return $this->Id_priorite;
    }

    /**
     * Get the value of etat_priorité
     */ 
    public function getEtat_priorite()
    {
        return $this->Etat_priorite;
    }
}