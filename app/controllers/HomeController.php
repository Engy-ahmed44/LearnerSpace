<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\View\Common\BaseSkeletonView;
use App\View\Home\HomeView;

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
        $baseView = new HomeView();
        (new BaseSkeletonView("Dashboard", $baseView))->render();
    }
}
