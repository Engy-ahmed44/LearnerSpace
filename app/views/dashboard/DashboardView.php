<?php

namespace App\View\Dashboard;

use App\Core\View;

class DashboardView extends View
{
    public static function index($courses, $events, $communityPosts)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>
        </head>

        <body>
            <h1>Welcome to the Dashboard</h1>

            <!-- Logout Button -->
            <form action="/LearnerSpace/user/logout" method="POST">
                <button type="submit">Logout</button>
            </form>

            <h2>Your Courses</h2>
            <?php if (empty($courses)): ?>
                <p>You don't have any courses yet.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($courses as $course): ?>
                        <li><?php echo htmlspecialchars($course->getTitle()); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <h2>Latest Events</h2>
            <?php if (empty($events)): ?>
                <p>No upcoming events for your courses.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($events as $event): ?>
                        <li><?php echo htmlspecialchars($event->getTitle()) . ' - ' . htmlspecialchars($event->getCreatedAt()->format('F j, Y, g:i a')); ?></li>
                        <!-- Formatting DateTime: 'F j, Y, g:i a' will display: "September 20, 2024, 3:30 pm" -->
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <h2>Latest Community Posts</h2>
            <?php if (empty($communityPosts)): ?>
                <p>No community posts available.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($communityPosts as $post): ?>
                        <li><?php echo htmlspecialchars($post->getTitle()) . ' - ' . htmlspecialchars($post->getCreatedAt()->format('F j, Y, g:i a')); ?></li>
                        <!-- Formatting DateTime: 'F j, Y, g:i a' will display: "September 20, 2024, 3:30 pm" -->
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </body>

        </html>
<?php
    }
}
