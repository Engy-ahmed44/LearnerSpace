<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\Auth\Strategy\EmailStrategy;
use App\View\Login\LoginView;

class LoginController extends Controller
{
    /**
     * Called after the request is received.
     */
    public function onCall()
    {
        if (AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('dashboard');
        }
    }

    /**
     * Show the login form.
     */
    public function index()
    {
        if (ControllerHelpers::isPost()) {
            $this->login();
        } else {
            // Show the login form by calling the static method from LoginView
            LoginView::showLoginForm();
        }
    }

    /**
     * Handle login attempt.
     */
    private function login()
    {
        if (ControllerHelpers::isPost()) {
            // Get sanitized input data
            $email = ControllerHelpers::post('email');
            $password = ControllerHelpers::post('password');

            // Create an authentication strategy based on email and password
            $strategy = new EmailStrategy($email, $password);

            // Authenticate using the provided credentials
            $authManager = AuthManager::getInstance();
            $success = $authManager->setStrategy($strategy)->authenticate();

            if ($success) {
                // Redirect to the dashboard or a secure page
                ControllerHelpers::redirect('dashboard');
            } else {
                // Show login form with error message
                LoginView::showLoginForm(['error' => 'Invalid email or password.']);
            }
        } else {
            // Redirect if not a POST request
            ControllerHelpers::redirect('login');
        }
    }
}
