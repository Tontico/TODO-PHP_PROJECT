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
        <header class="bgdark p-3 d-flex justify-content-between align-items-center">
            <div class="col-1 d-flex text-light align-items-center">
                <img src="public/assets/logo.png" alt="logo" style="width: 50px; height: 50px;">
                <h1>Gest'Flex</h1>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark col-10">
                <ul class="navbar-nav mx-auto justify-content-around" style="width:100%">
                    <?php if (SecurityController::isConnected()) : ?>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('ProjectController', 'displayProjet'); ?>">
                                <h1>Mes projets</h1>
                            </a></li>
                        <li class="nav-item"><a class="nav-link text-light" href="<?= UrlGenerator::generateUrl('SecurityController', 'deconnexion'); ?>">
                                <h1>Se déconnecter</h1>
                            </a></li>
                    <?php endif; ?>
                </ul>
         
            <?php 
            if (SecurityController::isConnected()){
                $dataURL="?";
                 if(isset($_GET)){
                   foreach($_GET as $cle => $valeur){
                    $dataURL= $dataURL."&".$cle ."=".$valeur;
                     }
                 
                }
   
             echo "<div class='nav-item'>
                    <form action='". $_SERVER['PHP_SELF'].$dataURL."' method='POST'>
                    <input type='submit' name='mode' class='btn btn-secondary buttonLD' value='".$_SESSION['mode']." mode'>
                    </form>
                    </div>";
}

?>
                    </nav>

            <div class="col-1 d-flex text-light align-items-center justify-content-end">
                <?php if (SecurityController::isConnected()) : ?>
                    <h1><?= $_SESSION['username'] ?></h1>
                <?php endif; ?>
                <img src="public/assets/avatars/avatar.jpg" alt="logo" style="width: 50px; height:50px; object-fit: cover; border-radius: 50%;">

            </div>
        </header>

<?php
    }
}
