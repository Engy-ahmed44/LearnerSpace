<?php

namespace App\View\Event;

use App\Core\View;

class CreateEventView extends View
{
    function render(): void
    {
?>
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
<?php
    }
}
