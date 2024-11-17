<?php

namespace App\View\CreateEvent;

use App\Core\View;

class CreateEventView extends View
{
    public static function index()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create Event</title>
        </head>

        <body>
            <h1>Create a New Event</h1>

            <!-- Event creation form -->
            <form action="/LearnerSpace/createevent/store" method="POST">
                <label for="name">Event Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="date">Event Date:</label><br>
                <!-- Date Picker for Event Date -->
                <input type="datetime-local" id="date" name="date" required><br><br>

                <button type="submit">Create Event</button>
            </form>

            <br><br>
            <a href="/LearnerSpace/dashboard">Back to Dashboard</a>

        </body>

        </html>
<?php
    }
}
