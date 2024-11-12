<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;

class HomeController extends Controller
{

    public function onCall()
    {
        if (AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('dashboard');
        }
    }

    public function index()
    {
        $this->view('home/index');
    }
}
