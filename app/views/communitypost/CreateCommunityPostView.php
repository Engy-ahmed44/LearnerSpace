<?php

namespace App\View\CommunityPost;

use App\Core\View;
use App\DB\Entity\CommunityPost;
use Doctrine\Common\Collections\Collection;

class CreateCommunityPostView extends View
{
    function render(): void
    {
?>

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

<?php
    }
}
