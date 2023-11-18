<?php

namespace Keha\Test\App;
//Class that create the url generator method
class UrlGenerator
{
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
}
