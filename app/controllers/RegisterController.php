<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\Auth\Strategy\EmailStrategy;
use App\DB\Repository\UserRepository;

class RegisterController extends Controller
{
    public function onCall()
    {
        if (AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('dashboard');
        }
    }

    public function index()
    {

        if (ControllerHelpers::isPost()) {
            $this->register();
        } else {
            // Render the login view
            $this->view('register/index');
        }
    }

    public function register()
    {
        // Get sanitized input data
        $email = ControllerHelpers::post('email');
        $password = ControllerHelpers::post('password');

        $user = UserRepository::get()->register($email, $password);

        if ($user) {
            $strategy = new EmailStrategy($email, $password);
            $authResult = AuthManager::getInstance()->setStrategy($strategy)->authenticate();

            ControllerHelpers::redirect('dashboard');
        } else {
            $this->view('register/index', ['error' => 'Error registering.']);
        }
    }
}
