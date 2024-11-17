<?php

namespace App\View\Register;

use App\Core\View;

class RegisterView extends View
{
    private String $error;

    function __construct(String $error = null)
    {
        $this->error = $error;
    }

    function render(): void
    {
?>
        <h2>Register</h2>

        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="/LearnerSpace/register">
            <label for="email">Email</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Password</label>
            <input type="password" name="password" required><br><br>

            <label for="user_type">User Type</label>
            <select name="user_type" required>
                <option value="student">Student</option>
                <option value="tutor">Tutor</option>
            </select><br><br>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="/LearnerSpace/login">Login here</a></p>

<?php
    }
}
