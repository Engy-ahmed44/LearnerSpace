<?php

namespace App\Auth\Strategy;

use App\DB\Entity\User;

/**
 * Interface for the authentication strategy
 */
interface AuthenticationStrategy
{
    /**
     * Returns the user or null;
     */
    public function authenticate(): ?User;
}