<?php

namespace App\Controllers;

use App\DB\DatabaseManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Repository\UserRepository;

class LoginController extends Controller
{
    public function index()
    {
        // Render the login view
        $this->view('login/index');

        var_dump(UserRepository::get()->findAll());
    }

    public function authenticate()
    {
        if (ControllerHelpers::isPost()) {
            // Get sanitized input data
            $username = ControllerHelpers::post('username');
            $password = ControllerHelpers::post('password');

            $userModel = $this->model('User');
            $user = $userModel->login($username, $password);

            if ($user) {
                // Set session data
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;

                // Redirect to home page
                ControllerHelpers::redirect('/home');
            } else {
                // Load login view with an error message
                $this->view('login/index', ['error' => 'Invalid username or password.']);
            }
        } else {
            // Redirect if not a POST request
            ControllerHelpers::redirect('/login');
        }
    }

    public function logout()
    {
        // Clear user session and redirect to login
        session_unset();
        session_destroy();
        ControllerHelpers::redirect('/login');
    }
}
