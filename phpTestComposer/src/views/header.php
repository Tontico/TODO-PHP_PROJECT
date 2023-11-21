<?php

namespace Keha\Test\Views;

// Import the urlGenerator Method

use Keha\Test\App\UrlGenerator;
use Keha\Test\Controller\SecurityController;

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
                <?php if (SecurityController::isConnected()) : ?>
                    <p class="m-0 ml-2">Bienvenue <?= $_SESSION['username'] ?></p>
                <?php endif; ?>

            </div>
            <nav class="navbar navbar-expand-lg navbar-dark col-11">
                <ul class="navbar-nav mx-auto justify-content-around" style="width:100%">
                    <?php if (!SecurityController::isConnected()) : ?>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('UserController', 'displayForm', "connexion"); ?>">Se connecter</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('UserController', 'displayForm', "inscription"); ?>">S'enregistrer</a></li>
                    <?php endif; ?>
                    <?php if (SecurityController::isConnected()) : ?>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ProjectController', 'displayProjet'); ?>">Mes projets</a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'deconnexion'); ?>">Se déconnecter</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
<?php
    }
}
