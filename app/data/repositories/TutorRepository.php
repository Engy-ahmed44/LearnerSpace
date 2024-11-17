<?php

namespace App\DB\Repository;

use App\DB\Entity\Tutor;
use App\DB\Entity\User;
use App\DB\Repository\BaseRepository;
use Doctrine\ORM\NoResultException;
use Exception;

/**
 * @template T of object
 */
class TutorRepository extends UserRepository
{
    /**
     * Get the entity class associated with this repository
     *
     * @return string
     */
    protected static function getEntityClass()
    {
        return Tutor::class;
    }

    /**
     * Registers a new user.
     *
     * @param string $email
     * @param string $password
     * @return Tutor
     * @throws Exception
     */
    public function register(string $email, string $password): Tutor
    {
        // Check if the email already exists in the database
        $existingUser = $this->findOneBy(['email' => $email]);
        if ($existingUser) {
            throw new Exception('Email is already taken.');
        }

        // Create a new User instance
        $user = new User(
            $email,
            password_hash($password, PASSWORD_BCRYPT),
            null,
            null
        );

        // Persist the new user to the database
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user; // Return the newly registered user
    }

    /**
     * Get courses created by a tutor.
     *
     * @param Tutor $tutor
     * @return Course[]
     */
    public function getCourses(Tutor $tutor): array
    {
        return $tutor->getCourses()->toArray();
    }
}
