<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;


class UserController extends Controller
{
    public function onCall()
    {
        if (!AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('home');
        }
    }

    public function index()
    {
        $this->view('user/index');
    }

    public function logout()
    {
        if (ControllerHelpers::isPost()) {
            AuthManager::getInstance()->logout();
            ControllerHelpers::redirect('home');
        } else {
            $this->index();
        }
    }
}
