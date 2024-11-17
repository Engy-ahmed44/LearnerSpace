<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;
use App\DB\Entity\Student;
use App\DB\Entity\Tutor;
use App\DB\Repository\StudentRepository;
use App\DB\Repository\TutorRepository;
use App\View\Common\BaseSkeletonView;
use App\View\Register\RegisterView;

class RegisterController extends Controller
{
    /**
     * Called after the request is received.
     */
    public function onCall()
    {
        if (AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('dashboard');
        }
    }


    /**
     * Show the registration view.
     */
    public function index()
    {

        if (ControllerHelpers::isPost()) {
            $this->register();
        } else {
            $baseView = new RegisterView();
            (new BaseSkeletonView("Register", $baseView))->render();
        }
    }

    /**
     * Handle student or tutor registration.
     */
    private function register()
    {
        if (ControllerHelpers::isPost()) {
            // Get sanitized input data
            $email = ControllerHelpers::post('email');
            $password = ControllerHelpers::post('password');
            $userType = ControllerHelpers::post('user_type'); // 'student' or 'tutor'

            // Validate inputs (example)
            if (empty($email) || empty($password) || empty($userType)) {
                // Show registration form with error message

                $baseView = new RegisterView('All fields are required.');
                (new BaseSkeletonView("Login", $baseView))->render();
                return;
            }

            // Check if user type is student or tutor
            if ($userType === 'student') {
                // Create student object and register
                $student = new Student();
                $student->setEmail($email);
                $student->setPassword($password); // Consider hashing the password before storing
                // Save the student (you can implement save logic in the Student model)
                $studentRepository = StudentRepository::get();
                $studentRepository->register($student);

                // Optionally, enroll the student in some courses
                // $courseRepository->enrollStudentInDefaultCourses($student);

                // Redirect to login page or dashboard
                ControllerHelpers::redirect('login');
            } elseif ($userType === 'tutor') {
                // Create tutor object and register
                $tutor = new Tutor();
                $tutor->setEmail($email);
                $tutor->setPassword($password); // Consider hashing the password before storing
                // Save the tutor (you can implement save logic in the Tutor model)
                $tutorRepository = TutorRepository::get();
                $tutorRepository->register($tutor);

                // Redirect to login page or dashboard
                ControllerHelpers::redirect('login');
            } else {

                $baseView = new RegisterView('Invalid user type.');
                (new BaseSkeletonView("Login", $baseView))->render();
            }
        } else {
            // Redirect if not a POST request
            ControllerHelpers::redirect('register');
        }
    }
}
