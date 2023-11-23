<?php

namespace Keha\Test\App;

use Keha\Test\Config\Config;

class Dispatcher {

    public static function Dispatch()
    {
        $c = false;
        $m = false;
        if (isset($_GET['controller']) && isset($_GET['method'])) {
            if (class_exists(Config::CONTROLLER.$_GET['controller'])) {
                $c = Config::CONTROLLER.$_GET['controller'];
                $controller = new $c();
                if (method_exists($controller,$_GET['method'])) {
                    $m = $_GET['method'];
                    $controller->$m();
                    return;
                }
            } 
        } 
        $c = Config::CONTROLLER.Config::DEFAULT_CONTROLLER;
        $m = Config::DEFAULT_METHOD;
        $controller = new $c();
        $controller->$m();
    }
}