<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .logout-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-button:hover {
            background-color: #ff3333;
        }
    </style>
</head>

<body>

    <div class="profile-container">
        <h2>Welcome, <?php echo htmlspecialchars($userName); ?></h2>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <form action="/LearnerSpace/user/logout" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

</body>

</html>