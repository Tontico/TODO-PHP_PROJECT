<?php

echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php">Revenir à la page d\'acceuil </a> </li><br>');

foreach ($abonnes as $value){
    echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=AbonneController&method=displayAbonne&id='.$value->getId().'">'.$value->getNom().' '.$value->getPrenom().'</a><br>');
    echo ('<a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=FormController&method=updateAbonneForm&id='.$value->getId().'">  Modifier l\'abonne</a></li>');
    echo '       ';
    echo ('<a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=AbonneController&method=deleteAbonne&id='.$value->getId().'">  Supprimer l\'abonne</a></li><br><br>');


}