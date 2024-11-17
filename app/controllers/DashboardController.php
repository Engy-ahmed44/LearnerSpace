<?php

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Entity\Student;
use App\DB\Entity\Tutor;
use App\DB\Repository\EventRepository;
use App\DB\Repository\CommunityPostRepository;
use App\View\Dashboard\DashboardView;

class DashboardController extends Controller
{
    /**
     * Called after the request is received.
     */
    public function onCall()
    {
        if (!AuthManager::getInstance()->isAuthenticated()) {
            ControllerHelpers::redirect('login');
        }
    }

    public function index()
    {
        $user = AuthManager::getInstance()->getUser();
        // Get the user's courses or enrolled courses
        if ($user instanceof Tutor) {
            // If the user is a Tutor, show the courses they created
            $courses = $user->getCourses();
        } elseif ($user instanceof Student) {
            // If the user is a Student, show the courses they are enrolled in
            $courses = $user->getEnrolledCourses();
        } else {
            $courses = [];
        }

        // Get the latest events for these courses
        $events = EventRepository::get()->findLatestByCourses($courses);

        // Get the latest community posts
        $communityPosts = CommunityPostRepository::get()->findLatestPosts();

        // Render the view
        DashboardView::index($courses, $events, $communityPosts);
    }
}
