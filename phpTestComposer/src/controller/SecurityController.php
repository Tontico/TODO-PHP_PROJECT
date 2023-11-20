<?php

namespace Keha\Test\Controller;

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
            UrlGenerator::redirect('IndexController', 'displayIndex');
        }
    }
}
