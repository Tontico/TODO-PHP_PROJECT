<?php

namespace Keha\Test\App;

// Class that creates the URL generator methods
class UrlGenerator
{
    // Method to generate a URL from query parameters
    public static function generateUrl($controller, $method, $query = [])
    {
        $url = 'index.php?controller=' . $controller . '&method=' . $method;
        if (!empty($query) && is_array($query)) {
            foreach ($query as $key => $value) {
                $url .= '&' . $key . '=' . $value;
            }
        }
        return $url;
    }

    // Method to redirect from query parameters
    public static function redirect($controllerName, $method)
    {
        // Stocker the datas session
        $sessionData = $_SESSION;

        // Redirect
        header('Location: ' . self::generateUrl($controllerName, $method));

        // Open Session if it's not already
        if (!isset($_SESSION)) {
            session_start();
        }
        // Give back the session datas
        $_SESSION = $sessionData;
        exit(); // Block the incoming code
    }
}
