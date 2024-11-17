<?php

namespace App\Controllers;

use App\Auth\AuthManager;
use App\Core\Controller;
use App\Core\ControllerHelpers;
use App\DB\Entity\Event;
use App\DB\Repository\EventRepository;
use App\View\CreateEvent\CreateEventView;
use App\DB\Entity\Tutor; // Assuming the creator must be a Tutor

class CreateEventController extends Controller
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
            ControllerHelpers::redirect('dashboard'); // Only allow Tutors to create events
        }
    }

    /**
     * Display the event creation form
     */
    public function index()
    {
        CreateEventView::index(); // Display the view for creating an event
    }

    /**
     * Store the newly created event in the database
     */
    public function store()
    {
        if (ControllerHelpers::isPost()) {
            $user = AuthManager::getInstance()->getUser();

            // Get input values for the new event
            $name = ControllerHelpers::post('name');
            $date = ControllerHelpers::post('date'); // Expected format: 'Y-m-d H:i:s'

            // Convert string date to DateTime object
            $eventDate = \DateTime::createFromFormat('Y-m-d\TH:i', $date);

            // Create a new event object
            $event = new Event($name, $eventDate);

            // Save the event in the database
            EventRepository::get()->create($event);

            // Redirect to the dashboard or a confirmation page
            ControllerHelpers::redirect('dashboard');
        }
    }
}
