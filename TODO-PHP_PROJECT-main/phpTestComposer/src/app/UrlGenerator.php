<?php

namespace Keha\Test\App;

// Class that creates the URL generator methods
class UrlGenerator
{
    // Method to generate a URL from query parameters
    public static function generateUrl($controller, $method, $formName = null, $key = null, $value = null, $query = [])
    {
        $url = 'index.php?controller=' . $controller . '&method=' . $method;
        // add the formName parameter if exist
        if ($formName !== null) {
            $url .= '&formName=' . $formName;
        }
        // add the formName parameter if exist
        if ($key !== null) {
            $url .= '&key=' . $key;
        }
        // add the formName parameter if exist
        if ($value !== null) {
            $url .= '&value=' . $key;
        }
        if (!empty($query) && is_array($query)) {
            foreach ($query as $key => $value) {
                $url .= '&' . $key . '=' . $value;
            }
        }
        return $url;
    }

    // Method to redirect from query parameters
    public static function redirect($controllerName, $method, $formName = null, $key = null, $value = null,)
    {
        // Stocker the datas session
        $sessionData = $_SESSION;

        // Redirect
        header('Location: ' . self::generateUrl($controllerName, $method, $formName, $key, $value));

        // Open Session if it's not already
        if (!isset($_SESSION)) {
            session_start();
        }
        // Give back the session datas
        $_SESSION = $sessionData;
        exit(); // Block the incoming code
    }
}
