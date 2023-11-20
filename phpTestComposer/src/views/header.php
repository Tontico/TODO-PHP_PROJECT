<?php

namespace Keha\Test\Views;

// Import the urlGenerator Method

use Keha\Test\App\UrlGenerator;
use Keha\Test\Controller\ConnexionController;

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
                <?php if (ConnexionController::isConnected()) : ?>
                    <p class="m-0 ml-2">Bienvenue <?= $_SESSION['username'] ?></p>
                <?php endif; ?>

            </div>
            <nav class="navbar navbar-expand-lg navbar-dark col-11">
                <ul class="navbar-nav mx-auto justify-content-around" style="width:100%">
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('IndexController', 'displayIndex'); ?>">Accueil</a></li>
                    <?php if (ConnexionController::isConnected()) : ?>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ProjectController', 'displayProjet'); ?>">Voir ses projets</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ConnexionController', 'displayConnexion'); ?>">Se connecter</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'inscription'); ?>">S'enregistrer</a></li>
                    <?php if (ConnexionController::isConnected()) : ?>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ConnexionController', 'deconnexion'); ?>">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
<?php
    }
}
