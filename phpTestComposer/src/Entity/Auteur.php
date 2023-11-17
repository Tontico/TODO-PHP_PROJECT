<?php

namespace Keha\Test\Entity;

class Auteur {
    private int $id;
    private ?string $nom;

    public function getNom()
    {
        return $this->nom;
    }


}