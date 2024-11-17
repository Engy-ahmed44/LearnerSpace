<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\View\Common\BaseSkeletonView;
use App\View\User\UserView;

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

        $baseView = new UserView(AuthManager::getInstance()->getUser());
        (new BaseSkeletonView("Profile", $baseView))->render();
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
