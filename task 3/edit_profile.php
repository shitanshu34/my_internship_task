<?php
/**
 * Edit Profile Page (CRUD - Update)
 * English version with Admin-logic fixed.
 */

session_start();
require_once 'config.php';

// 1. Security Check: Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// FIX: Determine which user to edit. 
// If an 'id' is in the URL and the person is an Admin, use that ID.
// Otherwise, use the logged-in user's own ID.
if (isset($_GET['id']) && $_SESSION['role_id'] == 1) {
    $user_id = $_GET['id'];
} else {
    $user_id = $_SESSION['user_id'];
}

$success_msg = "";
$error_msg = "";

// 2. Fetch target user data
$query = "SELECT username, email, profile_pic FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found!");
}
mysqli_stmt_close($stmt);

// 3. Handle Update Form Submission
if (isset($_POST['update_btn'])) {
    $new_username = mysqli_real_escape_string($conn, $_POST['username']);
    $profile_pic = $user['profile_pic']; 
    $upload_ok = true; 

    // Image Upload Validation
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $allowed_types = ['jpg', 'jpeg', 'png'];
        $max_size = 2 * 1024 * 1024;
        
        $file_name = $_FILES["profile_pic"]["name"];
        $file_size = $_FILES["profile_pic"]["size"];
        $tmp_name = $_FILES["profile_pic"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_types)) {
            $error_msg = "Invalid format! Only JPG, JPEG, and PNG allowed.";
            $upload_ok = false;
        } elseif ($file_size > $max_size) {
            $error_msg = "File too large! Max size 2MB.";
            $upload_ok = false;
        } else {
            $target_dir = "uploads/";
            $new_file_name = time() . "_" . basename($file_name);
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($tmp_name, $target_file)) {
                $profile_pic = $new_file_name;
            } else {
                $error_msg = "Upload failed.";
                $upload_ok = false;
            }
        }
    }

    if ($upload_ok) {
        $update_query = "UPDATE users SET username = ?, profile_pic = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        
        if ($update_stmt) {
            mysqli_stmt_bind_param($update_stmt, "ssi", $new_username, $profile_pic, $user_id);
            if (mysqli_stmt_execute($update_stmt)) {
                // Only update session if editing OWN profile
                if ($user_id == $_SESSION['user_id']) {
                    $_SESSION['username'] = $new_username;
                }
                $success_msg = "Profile updated successfully!";
                $user['username'] = $new_username;
                $user['profile_pic'] = $profile_pic;
            } else {
                $error_msg = "Update failed.";
            }
            mysqli_stmt_close($update_stmt);
        }
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
    <div class="edit-container" style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #fff;">
        <h2>Edit Profile (ID: <?php echo $user_id; ?>)</h2>
        
        <?php if($success_msg) echo "<p style='color:green; font-weight:bold;'>$success_msg</p>"; ?>
        <?php if($error_msg) echo "<p style='color:red; font-weight:bold;'>$error_msg</p>"; ?>

        <!-- Note: We keep the id in the URL to ensure it updates the right person -->
        <form action="edit_profile.php?id=<?php echo $user_id; ?>" method="POST" enctype="multipart/form-data">
            <div style="margin-bottom: 15px;">
                <label>Current Photo:</label><br>
                <img src="uploads/<?php echo htmlspecialchars($user['profile_pic']); ?>" width="80" height="80" style="border-radius: 50%; margin-top: 5px; border: 2px solid #007bff; object-fit: cover;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Username:</label><br>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required style="width: 100%; padding: 8px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>New Photo (Max 2MB):</label><br>
                <input type="file" name="profile_pic" accept="image/jpeg, image/png">
            </div>

            <button type="submit" name="update_btn" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%;">Update Data</button>
            <br><br>
            <a href="users_list.php" style="display: block; text-align: center;">Back to List</a>
        </form>
    </div>
</body>
</html>