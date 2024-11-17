<?php

namespace App\Auth\Strategy;

use App\DB\Entity\Student;
use App\DB\Entity\User;
use App\DB\Repository\StudentRepository;
use App\DB\Repository\TutorRepository;
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
        return UserRepository::get()->findUserByEmailAndPassword($this->email, $this->password);
    }
}
