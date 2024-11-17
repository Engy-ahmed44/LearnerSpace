<?php

namespace App\View\CreateCourse;

use App\Core\View;

class CreateCourseView extends View
{
    public static function index()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create New Course</title>
        </head>

        <body>
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

        </body>

        </html>
<?php
    }
}
