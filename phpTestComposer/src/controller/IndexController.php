<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;

class IndexController extends AbstractController {

    public function index()
    {
        $this->render('index.php',[]);
    }
}