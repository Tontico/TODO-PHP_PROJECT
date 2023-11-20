<?php

namespace Keha\Test\Entity;

class Priorité{
    private int $id_priorité;
    private string $etat_priorité;

    /**
     * Get the value of id_priorité
     */ 
    public function getId_priorité()
    {
        return $this->id_priorité;
    }

    /**
     * Get the value of etat_priorité
     */ 
    public function getEtat_priorité()
    {
        return $this->etat_priorité;
    }
}