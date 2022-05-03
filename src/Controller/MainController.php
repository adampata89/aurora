<?php

namespace App\Controller;

use Devanych\View\Renderer;


class MainController
{
    private $path = 'src/view/';

    public function view(){
        if (isset($_SESSION['user'])){
            header('Location: /products');
        } else {
            header('Location: /login');
        }
    }
}

