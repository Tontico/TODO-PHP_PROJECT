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
        header('Location: ' . self::generateUrl($controllerName, $method));
        exit(); // Block the code after the redirect
    }
}
