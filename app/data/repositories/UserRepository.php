<?php

namespace App\DB\Repository;

use App\DB\Entity\User;
use App\DB\Repository\BaseRepository;
use Doctrine\ORM\NoResultException;
use Exception;

/**
 * @template T of object
 */
abstract class UserRepository extends BaseRepository
{
    /**
     * Find a user by email and password (hashed password should be checked).
     *
     * @param string $email The user's email.
     * @param string $password The plain text password.
     *
     * @return T|null The user entity if found and password matches, null otherwise.
     */
    public function findUserByEmailAndPassword(string $email, string $password): ?object
    {
        // Create the QueryBuilder
        $qb = $this->createQueryBuilder('u');

        // Build the query with email check
        $qb->where('u.email = :email')
            ->setParameter('email', $email);

        try {
            $user = $qb->getQuery()->getSingleResult();

            // Check if the password matches (assuming the password is hashed)
            if (password_verify($password, $user->getPassword())) {
                return $user;
            }
        } catch (NoResultException $e) {
            return null; // No user found
        }

        return null; // Password doesn't match or user doesn't exist
    }

    /**
     * Find a user by their ID.
     *
     * @param int $id The ID of the user to find.
     * @return T|null Returns the User entity or null if not found.
     */
    public function findUserById(int $id): ?object
    {
        return $this->find($id);
    }
}
