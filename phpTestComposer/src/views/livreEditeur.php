<?php

echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php">Revenir à la page d\'acceuil </a> </li>');
echo ("<h1>Editeur : " . $editeur->getNom() . "</h1>");

echo ("Liste des livres de cet editeur: <br>");
foreach ($livres as $value){
    echo '<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivreAuteurEditeur&id='.$value->getId().'&idAuteur='.$value->getAuteurId().'&idEditeur='.$value->getEditeurId().'">'.$value->getTitre().
    '</a></li>';

}
// var_dump($livres);
