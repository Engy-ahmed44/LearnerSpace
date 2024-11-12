<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\Auth\Strategy\EmailStrategy;


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
        AuthManager::getInstance()->logout();
        ControllerHelpers::redirect('home');
    }
}
