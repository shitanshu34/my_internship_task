<?php
/**
 * Users List Page (CRUD - Read & Delete)
 * Purpose: Display all users in a table and provide a delete option.
 * Security Update: Role-Based Access Control (Admin Only)
 */

session_start();
require_once 'config.php';

// 1. Security Check: Only logged-in users can access
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. ROLE-BASED SECURITY: Only Admin (role_id = 1) can view this list
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    echo "<script>alert('Access Denied: Admin privileges required!'); window.location='dashboard.php';</script>";
    exit();
}

// 3. Fetch all users from the database
$query = "SELECT id, username, email, profile_pic FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users - Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Table Specific Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registered Users List (Admin Access)</h2>
        <a href="dashboard.php" style="margin-bottom: 15px; display: inline-block; color: #007bff; text-decoration: none; font-weight: bold;">← Back to Dashboard</a>
        
        <table>
            <thead>
                <tr>
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
                        <img src="uploads/<?php echo htmlspecialchars($row['profile_pic']); ?>" 
                             width="45" height="45" 
                             style="border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                    </td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="edit_profile.php?id=<?php echo $row['id']; ?>" style="color: #28a745; text-decoration: none; font-weight: bold;">Edit</a> | 
                        
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                           style="color: #dc3545; text-decoration: none; font-weight: bold;" 
                           onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>