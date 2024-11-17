<?php

namespace App\View\Dashboard;

use App\Core\View;
use Doctrine\Common\Collections\Collection;

class DashboardView extends View
{

    private $courses;
    private $events;
    private $communityPosts;

    function __construct($courses, $events, $communityPosts)
    {
        $this->courses = $courses;
        $this->events = $events;
        $this->communityPosts = $communityPosts;
    }

    function render(): void
    {
?>

        <h1>Welcome to the Dashboard</h1>

        <!-- Logout Button -->
        <form action="/LearnerSpace/user/logout" method="POST">
            <button type="submit">Logout</button>
        </form>

        <h2>Your Courses</h2>
        <?php if (empty($this->courses)): ?>
            <p>You don't have any courses yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->courses as $course): ?>
                    <li><?php echo htmlspecialchars($course->getTitle()); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Latest Events</h2>
        <?php if (empty($this->events)): ?>
            <p>No upcoming events for your courses.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->events as $event): ?>
                    <li><?php echo htmlspecialchars($event->getName()) . ' - ' . htmlspecialchars($event->getDate()->format('F j, Y, g:i a')); ?></li>
                    <!-- Formatting DateTime: 'F j, Y, g:i a' will display: "September 20, 2024, 3:30 pm" -->
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Latest Community Posts</h2>
        <?php if (empty($this->communityPosts)): ?>
            <p>No community posts available.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->communityPosts as $post): ?>
                    <li><?php echo htmlspecialchars($post->getTitle()) . ' - ' . htmlspecialchars($post->getCreatedAt()->format('F j, Y, g:i a')); ?></li>
                    <!-- Formatting DateTime: 'F j, Y, g:i a' will display: "September 20, 2024, 3:30 pm" -->
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
<?php
    }
}
