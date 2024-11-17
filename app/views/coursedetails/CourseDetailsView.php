<?php

namespace App\View\CourseDetails;

use App\Core\View;

class CourseDetailsView extends View
{
    public static function index($course)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Course Details</title>
        </head>

        <body>
            <h1><?php echo htmlspecialchars($course->getTitle()); ?> - Details</h1>

            <h2>Description</h2>
            <p><?php echo nl2br(htmlspecialchars($course->getDescription())); ?></p>

            <h2>Tutor</h2>
            <p><?php echo htmlspecialchars($course->getTutor()->getFullName()); ?> (Tutor)</p>

            <h2>Enrolled Students</h2>
            <?php if (empty($course->getStudents())): ?>
                <p>No students are enrolled in this course yet.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($course->getStudents() as $student): ?>
                        <li><?php echo htmlspecialchars($student->getFullName()); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <h2>Course Content</h2>
            <?php if (empty($course->getContent())): ?>
                <p>No content available for this course.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($course->getContent() as $content): ?>
                        <li><?php echo htmlspecialchars($content->getTitle()); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Button to go back to dashboard or previous page -->
            <a href="/LearnerSpace/dashboard">Back to Dashboard</a>
        </body>

        </html>
<?php
    }
}
