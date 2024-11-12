<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>

    <?php if (!empty($data['error'])): ?>
        <p style="color: red;"><?php echo $data['error']; ?></p>
    <?php endif; ?>

    <form action="/LearnerSpace/register" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Register</button>
    </form>
</body>

</html>