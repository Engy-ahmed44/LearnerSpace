<?php

namespace App\Auth\Strategy;

use App\DB\Entity\User;

enum UserType: string
{
    case STUDENT = 's';
    case TUTOR = 't';
}

/**
 * Interface for the authentication strategy
 */
interface AuthenticationStrategy
{
    /**
     * Returns the user or null.
     *
     * @return Student|Tutor|null
     */
    public function authenticate(): ?User;
}
