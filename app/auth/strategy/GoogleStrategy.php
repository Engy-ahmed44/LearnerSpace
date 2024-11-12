<?php

namespace App\Auth\Strategy;

use App\DB\Entity\User;

class GoogleStrategy implements AuthenticationStrategy
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function authenticate(): ?User
    {

        // TODO: - Add logic
        return null;
    }
}
