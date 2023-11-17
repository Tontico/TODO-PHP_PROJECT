<?php

echo ('Le titre du livre : '.$livre->getTitre());
echo '<br>';
echo ('Le genre du livre : '.$livre->getGenre());
echo '<br>';
echo ('La catégorie du livre : '.$livre->getCategorie());
echo '<br>';
echo ('L\'auteur du livre : ');
echo ('<a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivreAuteur&&idAuteur='.$livre->getAuteurId().'">'.$auteur->getNom().'</a>');
echo '<br>';
echo ('L\'editeur du livre :');
echo ('<a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivreEditeur&idEditeur='.$livre->getEditeurId().'">'.$editeur->getNom().'</a>');
echo '<br>';
echo '<br>';
echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=LivreController&method=displayLivres">Revenir à la liste des livres </a> </li>');