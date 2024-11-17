<?php

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Entity\Course;
use App\DB\Repository\CourseRepository;
use App\DB\Entity\Tutor;
use App\View\CreateCourse\CreateCourseView;

class CreateCourseController extends Controller
{
    /**
     * Called after the request is received.
     */
    public function onCall()
    {
        if (!AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('login');
        }

        // Check if the logged-in user is a Tutor
        $user = AuthManager::getInstance()->getUser();
        if (!($user instanceof Tutor)) {
            ControllerHelpers::redirect('dashboard'); // Only allow Tutors to create courses
        }
    }

    public function index()
    {
        CreateCourseView::index();
    }

    public function store()
    {
        if (ControllerHelpers::isPost()) {
            $user = AuthManager::getInstance()->getUser();

            // Get the input values for the new course
            $title = ControllerHelpers::post('title');
            $description = ControllerHelpers::post('description');

            // Create a new course object
            $course = new Course($title, $user, $description);

            // Save the course in the database
            $courseRepository = CourseRepository::get()->create($course);

            // Redirect to the dashboard or a page confirming the creation
            ControllerHelpers::redirect('dashboard');
        }
    }
}
