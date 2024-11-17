<?php

namespace App\View\Course;

use App\Core\View;
use App\DB\Entity\Course;

class CreateCourseView extends View
{
    function render(): void
    {
?>

        <h1>Create a New Course</h1>

        <form action="/LearnerSpace/createcourse/store" method="POST">
            <div>
                <label for="title">Course Title</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div>
                <label for="description">Course Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div>
                <button type="submit">Create Course</button>
            </div>
        </form>
<?php
    }
}
