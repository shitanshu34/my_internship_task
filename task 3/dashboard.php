<?php
/**
 * User Dashboard
 * Fully Secured and English Version
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'config.php';

// Access Control: If not logged in, kick out to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = "";
$profile_pic = "default.png";

// Fetch user info from database using Prepared Statement
$query = "SELECT username, profile_pic FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($user = mysqli_fetch_assoc($result)) {
        $username = $user['username'];
        $profile_pic = $user['profile_pic'];
    } else {
        $username = $_SESSION['username']; // Fallback
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Apex Internship</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container" style="text-align: center; max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <div class="profile-section">
            <img src="uploads/<?php echo htmlspecialchars($profile_pic); ?>" 
                 alt="User Profile" 
                 style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #007bff; object-fit: cover; margin-bottom: 20px;">
        </div>
        
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>You have successfully logged in to your secure internship dashboard.</p>
        
        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">

        <div class="actions" style="display: flex; flex-direction: column; gap: 15px;">
            <a href="users_list.php" style="background-color: #007bff; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">View All Users (CRUD)</a>
            
            <a href="edit_profile.php?id=<?php echo $user_id; ?>" style="background-color: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">Edit My Profile</a>
            
            <a href="logout.php" style="color: #dc3545; font-weight: bold; text-decoration: none; border: 1px solid #dc3545; padding: 8px; border-radius: 5px; margin-top: 10px;">Logout</a>
        </div>
    </div>
</body>
</html>