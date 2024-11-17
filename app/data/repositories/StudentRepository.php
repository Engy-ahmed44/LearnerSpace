<?php

namespace App\DB\Repository;

use App\DB\Entity\Course;
use App\DB\Entity\Student;
use App\DB\Entity\User;
use App\DB\Repository\BaseRepository;
use Doctrine\ORM\NoResultException;
use Exception;

/**
 * @template T of object
 */
class StudentRepository extends UserRepository
{
    /**
     * Get the entity class associated with this repository
     *
     * @return string
     */
    protected static function getEntityClass()
    {
        return Student::class;
    }

    /**
     * Registers a new user.
     *
     * @param string $email
     * @param string $password
     * @return Student
     * @throws Exception
     */
    public function register(string $email, string $password): Student
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
     * Enroll a student in a course.
     *
     * @param Student $student
     * @param Course $course
     */
    public function enrollInCourse(Student $student, Course $course): void
    {
        $student->getEnrolledCourses()->add($course);
        $this->getEntityManager()->flush();
    }

    /**
     * Get courses a student is enrolled in.
     *
     * @param Student $student
     * @return Course[]
     */
    public function getEnrolledCourses(Student $student): array
    {
        return $student->getEnrolledCourses()->toArray();
    }
}
