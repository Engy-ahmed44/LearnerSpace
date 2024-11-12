<?php

namespace App\Auth\Strategy;

use App\DB\Entity\User;
use App\DB\Repository\UserRepository;

class EmailStrategy implements AuthenticationStrategy
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function authenticate(): ?User
    {
        // TODO: - hash

        return UserRepository::get()->findUserByEmailAndPassword($this->email, $this->password);
    }
}
