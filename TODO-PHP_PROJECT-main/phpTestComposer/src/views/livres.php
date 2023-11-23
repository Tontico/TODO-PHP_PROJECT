<?php

echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php">Revenir à la page d\'acceuil </a> </li><br>');

foreach ($livres as $value){
    echo '<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivreAuteurEditeur&id='.$value->getId().'&idAuteur='.$value->getAuteurId().'&idEditeur='.$value->getEditeurId().'">'.$value->getTitre().
    '</a></li>';
    echo ('<a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=FormController&method=updateLivreForm&id='.$value->getId().'">  Modifier le livre</a><br><br>');


}
