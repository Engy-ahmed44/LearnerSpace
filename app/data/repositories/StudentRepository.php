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
     * @param Student $student
     * @return Student
     * @throws Exception
     */
    public function register(Student $student): Student
    {
        // Check if the email already exists in the database
        $existingUser = $this->findOneBy(['email' => $student->getEmail()]);
        if ($existingUser) {
            throw new Exception('Email is already taken.');
        }

        // Create a new User instance
        $student->setPassword(
            password_hash($student->getPassword(), PASSWORD_BCRYPT)
        );

        // Persist the new user to the database
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();

        return $student; // Return the newly registered user
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
