<?php

namespace App\View\Course;

use App\Core\View;
use App\DB\Entity\Course;

class CourseDetailsView extends View
{
    private Course $course;

    function __construct(Course $course)
    {
        $this->course = $course;
    }

    function render(): void
    {
?>

        <h1><?php echo htmlspecialchars($this->course->getTitle()); ?> - Details</h1>

        <h2>Description</h2>
        <p><?php echo nl2br(htmlspecialchars($this->course->getDescription())); ?></p>

        <h2>Tutor</h2>
        <p><?php echo htmlspecialchars($this->course->getTutor()->getFullName()); ?> (Tutor)</p>

        <h2>Enrolled Students</h2>
        <?php if (empty($this->course->getStudents())): ?>
            <p>No students are enrolled in this course yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->course->getStudents() as $student): ?>
                    <li><?php echo htmlspecialchars($student->getFullName()); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Course Content</h2>
        <?php if (empty($this->course->getContent())): ?>
            <p>No content available for this course.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->course->getContent() as $content): ?>
                    <li><?php echo htmlspecialchars($content->getTitle()); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Button to go back to dashboard or previous page -->
        <a href="/LearnerSpace/dashboard">Back to Dashboard</a>
<?php
    }
}
