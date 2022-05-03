<?php

namespace App\Controller;

class Controller
{
    protected $path = 'src/view/layouts/';
    public function __construct()
    {
        session_start();
    }
}
