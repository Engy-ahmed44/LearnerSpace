<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;

class DashboardController extends Controller
{

    public function onCall()
    {
        if (!AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('home');
        }
    }

    public function index()
    {
        $this->view('dashboard/index');
    }
}
