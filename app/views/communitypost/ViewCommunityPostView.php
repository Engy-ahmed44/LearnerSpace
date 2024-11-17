<?php

namespace App\View\CommunityPost;

use App\Core\View;
use App\DB\Entity\CommunityPost;

class ViewCommunityPostView extends View
{
    private CommunityPost $post;

    function __construct(CommunityPost $post)
    {
        $this->post = $post;
    }

    function render(): void
    {
?>
        <h1><?php echo htmlspecialchars($this->post->getTitle()); ?></h1>
        <p><strong>Posted by:</strong> <?php echo htmlspecialchars($this->post->getAuthor()->getFullName()); ?></p>
        <p><strong>Posted on:</strong> <?php echo $this->post->getCreatedAt()->format('Y-m-d H:i'); ?></p>
        <div>
            <p><?php echo nl2br(htmlspecialchars($this->post->getContent())); ?></p>
        </div>

        <a href="/community-post">Back to Posts</a>
<?php
    }
}
