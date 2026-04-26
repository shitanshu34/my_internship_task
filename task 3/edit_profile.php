<?php
/**
 * Edit Profile Page (CRUD - Update)
 * Purpose: Allow users to update their username and profile picture.
 */

session_start();
require_once 'config.php';

// 1. Security Check: Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success_msg = "";
$error_msg = "";

// 2. Fetch current user data
$query = "SELECT username, email, profile_pic FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// 3. Handle Update Form Submission
if (isset($_POST['update_btn'])) {
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $profile_pic = $user['profile_pic']; // Keep old pic by default

    // Handle New Image Upload if selected
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $file_name; // Update with new filename
        }
    }

    // Update Database using Prepared Statement
    $update_query = "UPDATE users SET username = ?, profile_pic = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($conn, $update_query);
    
    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "ssi", $new_username, $profile_pic, $user_id);
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['username'] = $new_username; // Update session
            $success_msg = "Profile updated successfully!";
            // Refresh local user data
            $user['username'] = $new_username;
            $user['profile_pic'] = $profile_pic;
        } else {
            $error_msg = "Update failed. Please try again.";
        }
        mysqli_stmt_close($update_stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile - Apex Internship</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="edit-container" style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Edit Your Profile</h2>
        
        <?php if($success_msg) echo "<p style='color:green;'>$success_msg</p>"; ?>
        <?php if($error_msg) echo "<p style='color:red;'>$error_msg</p>"; ?>

        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <div style="margin-bottom: 15px;">
                <label>Current Profile Photo:</label><br>
                <img src="uploads/<?php echo $user['profile_pic']; ?>" width="80" height="80" style="border-radius: 50%; margin-top: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Username:</label><br>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required style="width: 100%; padding: 8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Change Profile Photo (Optional):</label><br>
                <input type="file" name="profile_pic" accept="image/*">
            </div>

            <button type="submit" name="update_btn" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Update Profile</button>
            <br><br>
            <a href="dashboard.php">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>