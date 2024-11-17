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
     * Registers a new user.
     *
     * @param string $email
     * @param string $password
     * @return T
     * @throws Exception
     */
    public function register(string $email, string $password): object
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
