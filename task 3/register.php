<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Apex Internship</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="registration-container">
        <h2>Create an Account</h2>
        <form action="register_action.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
            </div>

            <button type="submit" name="register_btn">Register Now</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>