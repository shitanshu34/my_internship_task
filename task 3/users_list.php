<?php
/**
 * Users List Page (CRUD - Read & Delete)
 * Purpose: Display all users in a table and provide a delete option.
 */

session_start();
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users from the database
$query = "SELECT id, username, email, profile_pic FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Internship Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="padding: 20px;">
        <h2>Registered Users List</h2>
        <a href="dashboard.php" style="margin-bottom: 10px; display: inline-block;">Back to Dashboard</a>
        
        <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Profile</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <img src="uploads/<?php echo $row['profile_pic']; ?>" width="40" height="40" style="border-radius: 50%;">
                    </td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_profile.php?id=<?php echo $row['id']; ?>" style="color: blue;">Edit</a> | 
                        
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                           style="color: red;" 
                           onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>