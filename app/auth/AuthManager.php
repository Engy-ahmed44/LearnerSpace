<?php

namespace App\Auth;

use App\Auth\Strategy\AuthenticationStrategy;
use App\DB\Entity\User;
use App\DB\Repository\UserRepository;

class AuthManager
{
    private static ?AuthManager $instance = null;
    private AuthenticationStrategy $authStrategy;

    /**
     * Private constructor to prevent instantiation.
     */
    private function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Get the single instance of the Auth class.
     */
    public static function getInstance(): AuthManager
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Change the authentication strategy dynamically.
     */
    public function setStrategy(AuthenticationStrategy $authStrategy): AuthManager
    {
        $this->authStrategy = $authStrategy;
        return $this;
    }

    /**
     * Authenticate the user using the assigned strategy.
     */
    public function authenticate(): bool
    {
        $user = $this->authStrategy->authenticate();
        if ($user) {
            $_SESSION['access_token'] = JWTHelper::generateToken(["user_id" => $user->getId()]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Log the user out by clearing the session.
     */
    public function logout(): void
    {

        if (!$this->isAuthenticated()) {
            return;
        }

        session_unset();
        session_destroy();
    }

    /**
     * Get the current authenticated user.
     */
    public function getUser(): ?User
    {
        if (isset($_SESSION['access_token'])) {
            $token = $_SESSION['access_token'];
            $payload = JWTHelper::validateToken($token);

            return UserRepository::get()->findUserById($payload->user_id);
        }

        return null;
    }

    /**
     * Check if the user is authenticated.
     */
    public function isAuthenticated(): bool
    {
        // TODO:  -Chech if token expired
        return isset($_SESSION['access_token']);
    }
}
