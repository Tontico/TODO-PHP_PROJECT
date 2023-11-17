<?php

echo ('le nom de l\'abonne est : '.$abonne->getNom());
echo '<br>';
echo ('le prenom de l\'abonne est : '.$abonne->getPrenom());
echo '<br>';
echo ('Date de naissance : '.$abonne->getDateNaissance());
echo '<br>';
echo ('Adresse : '.$abonne->getAdresse());
echo '<br>';
echo ('Code postal : '.$abonne->getCodePostal());
echo (' Ville : '.$abonne->getVille());
echo '<br>';
echo '<br>';
echo ('<li><a href="http://localhost/phpobjet/phpTestComposer/index.php?controller=IndexController&method=index">Revenir à l\'acceuil </a> </li>');