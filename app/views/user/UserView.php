<?php

namespace App\View\User;

use App\Core\View;
use App\DB\Entity\User;

class UserView extends View
{
    private User $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    function render(): void
    {
?>


        <div class="profile-container">
            <h2>Welcome, <?php echo htmlspecialchars($this->user->getFullName()); ?></h2>
            <p>Email: <?php echo htmlspecialchars($this->user->getEmail()); ?></p>
            <form action="/LearnerSpace/user/logout" method="post">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
<?php
    }
}
