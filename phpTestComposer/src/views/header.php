<?php

namespace Keha\Test\Views;

// Import the urlGenerator Method
require_once(__DIR__ . './../App/UrlGenerator.php');


use Keha\Test\App\UrlGenerator;


//Class that create the header
class Header
{
    public function displayHeader()
    {
?>
        <!-- Header with some bootstraps -->
        <header class="bg-dark p-3 d-flex justify-content-between">
            <div class="col-1 d-flex text-light align-items-center">
                <img src="public/assets/logo.png" alt="logo" style="width: 50px; height: 50px;">
                <p class="m-0 ml-2">Gest'Flex</p>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark col-11">
                <ul class="navbar-nav mx-auto justify-content-around" style="width:100%">
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('IndexController', 'displayIndex'); ?>">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ConnexionController', 'displayConnexion'); ?>">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'inscription'); ?>">S'enregistrer</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'dexonnexion'); ?>">Se déconnecter</a></li>
                </ul>
            </nav>
        </header>
<?php
    }
}
