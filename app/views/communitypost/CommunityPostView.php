<?php

namespace App\View\CommunityPost;

use App\Core\View;
use App\DB\Entity\CommunityPost;

class CommunityPostView extends View
{
    // List of Community Posts
    public static function index($posts)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Community Posts</title>
        </head>

        <body>
            <h1>Community Posts</h1>

            <?php if (empty($posts)): ?>
                <p>No community posts available.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($posts as $post): ?>
                        <li>
                            <a href="/community-post/<?php echo $post->getId(); ?>">
                                <?php echo htmlspecialchars($post->getTitle()); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </body>

        </html>
    <?php
    }

    // Single Post Details
    public static function viewPost(CommunityPost $post)
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($post->getTitle()); ?></title>
        </head>

        <body>
            <h1><?php echo htmlspecialchars($post->getTitle()); ?></h1>
            <p><strong>Posted by:</strong> <?php echo htmlspecialchars($post->getAuthor()->getFullName()); ?></p>
            <p><strong>Posted on:</strong> <?php echo $post->getCreatedAt()->format('Y-m-d H:i'); ?></p>
            <div>
                <p><?php echo nl2br(htmlspecialchars($post->getContent())); ?></p>
            </div>

            <a href="/community-post">Back to Posts</a>
        </body>

        </html>
    <?php
    }


    public static function createView(): void
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create Community Post</title>
        </head>

        <body>

            <h1>Create a New Community Post</h1>

            <form action="/LearnerSpace/communitypost/store" method="POST">
                <div>
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required><br><br>
                </div>

                <div>
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" required></textarea><br><br>
                </div>

                <div>
                    <button type="submit">Create Post</button>
                </div>
            </form>

        </body>

        </html>
<?php
    }
}
