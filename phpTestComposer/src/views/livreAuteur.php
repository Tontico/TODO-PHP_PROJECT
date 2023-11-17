<?php

echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php">Revenir à la page d\'acceuil </a> </li>');
echo ("<h1>Auteur : " . $auteur->getNom() . "</h1>");

echo ("Liste des livres de cet auteur: <br>");

foreach ($livres as $value){
    echo '<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivreAuteurEditeur&id='.$value->getId().'&idAuteur='.$value->getAuteurId().'&idEditeur='.$value->getEditeurId().'">'.$value->getTitre().
    '</a></li>';


}