<?php

namespace App\Core;

abstract class Controller
{

    /**
     * Called before the method is called.
     */
    public function onCall() {}


    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }
}