<?php

namespace App\View\CommunityPost;

use App\Core\View;
use App\DB\Entity\CommunityPost;
use Doctrine\Common\Collections\Collection;

class CommunityPostsView extends View
{
    /**
     * CommunityPost[]
     */
    private array $posts;

    function __construct(array $posts)
    {
        $this->posts = $posts;
    }

    function render(): void
    {
?>
        <h1>Community Posts</h1>

        <?php if (empty($posts)): ?>
            <p>No community posts available.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($this->posts as $post): ?>
                    <li>
                        <a href="/community-post/<?php echo $post->getId(); ?>">
                            <?php echo htmlspecialchars($post->getTitle()); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
<?php
    }
}
