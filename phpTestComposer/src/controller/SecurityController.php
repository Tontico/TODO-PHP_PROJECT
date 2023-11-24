<?php

namespace Keha\Test\Controller;

use Keha\Test\App\Model;
use Keha\Test\App\UrlGenerator;
use Keha\Test\App\AbstractController;

class SecurityController extends AbstractController
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    // Method to check if the user is connected
    public static function isConnected()
    {
        if (isset($_SESSION['connected'])) {
            return true;
        }
        return false;
    }

    // Method to disconnect the user
    public static function deconnexion()
    {
        if ($_SESSION['connected']) {
            session_destroy();
            UrlGenerator::redirect('UserController', 'displayForm', 'connexion');
        }
    }

    // Method to verify if user is admin
    public static function isAdmin($idProject)
    {
        // Catch project datas by ID
        $projectInfo = Model::getInstance()->getByAttribute('projet', 'Id_projet', $idProject);

        // Verify if datas were found
        if (!empty($projectInfo) && isset($projectInfo[0])) {
            // Get the projetc's ID's admin
            $id_administrateur = $projectInfo[0]->getId_administrateur();

            // Get the admin datas by ID
            $userInfo = Model::getInstance()->getByAttribute('administrateur', 'Id_administrateur', $id_administrateur);

            // Verify if datas were found
            if (!empty($userInfo) && isset($userInfo[0])) {
                // Get the id_utilisateur link to the id_administrateur
                $idUtilisateur = $userInfo[0]->getId_utilisateur();

                // Check if IDs match
                if ($idUtilisateur === $_SESSION['userId']) {

                    return true;
                }
            }
        }
        // User isn't admin of the project
        return false;
    }
}
