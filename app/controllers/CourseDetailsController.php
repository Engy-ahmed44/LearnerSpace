<?php

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Repository\CourseRepository;
use App\View\CourseDetails\CourseDetailsView;

class CourseDetailsController extends Controller
{
    /**
     * Called after the request is received.
     */
    public function onCall()
    {
        // Only allow access to authenticated users
        if (!AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('login');
        }
    }

    /**
     * Show the details of a course.
     */
    public function index($courseId)
    {
        // Fetch the course by ID
        $course = CourseRepository::get()->find($courseId);

        if ($course == null) {
            ControllerHelpers::redirect('dashboard'); // Redirect if course not found
        }

        // Render the course details view
        CourseDetailsView::index($course);
    }
}
