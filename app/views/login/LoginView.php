<?php

namespace App\View\Login;

use App\Core\View;

class LoginView extends View
{
    private String $error;

    function __construct(String $error = null)
    {
        $this->error = $error;
    }

    function render(): void
    {
?>
        <h2>Login</h2>

        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="/LearnerSpace/login">
            <label for="email">Email</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Password</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="/LearnerSpace/register">Register here</a></p>

<?php
    }
}
