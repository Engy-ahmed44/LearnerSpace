<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\Auth\Strategy\EmailStrategy;


class LoginController extends Controller
{
    public function onCall()
    {
        if (AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('dashboard');
        }
    }

    public function index()
    {
        // Render the login view
        $this->view('login/index');
    }

    public function authenticate()
    {
        if (ControllerHelpers::isPost()) {
            // Get sanitized input data
            $email = ControllerHelpers::post('email');
            $password = ControllerHelpers::post('password');

            $strategy = new EmailStrategy($email, $password);

            $success = AuthManager::getInstance()->setStrategy($strategy)->authenticate();

            if ($success) {
                ControllerHelpers::redirect('dashboard');
            } else {
                $this->view('login/index', ['error' => 'Invalid username or password.']);
            }
        } else {
            // Redirect if not a POST request
            ControllerHelpers::redirect('login');
        }
    }
}
