<?php
/**
 * Registration Action Handler
 * Purpose: Process user registration and save hashed passwords.
 * Security Update: Added Server-Side Image Validation (Type & Size)
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

if (isset($_POST['register_btn'])) {
    // Sanitize and trim inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']); 

    // Secure password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Profile Picture Logic with Validation
    $profile_pic = "default.png";
    $upload_ok = true; // Flag for validation

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        
        $allowed_types = ['jpg', 'jpeg', 'png']; // Allowed extensions
        $max_size = 2 * 1024 * 1024; // 2MB maximum size
        
        $file_name = $_FILES["profile_pic"]["name"];
        $file_size = $_FILES["profile_pic"]["size"];
        $tmp_name = $_FILES["profile_pic"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validation 1: Check File Type
        if (!in_array($file_ext, $allowed_types)) {
            echo "Invalid file format! Only JPG, JPEG, and PNG are allowed. <a href='register.php'>Try again</a>";
            $upload_ok = false;
        } 
        // Validation 2: Check File Size
        elseif ($file_size > $max_size) {
            echo "File is too large! Maximum allowed size is 2MB. <a href='register.php'>Try again</a>";
            $upload_ok = false;
        } 
        // If validation passes, move the file
        else {
            $target_dir = "uploads/";
            $new_file_name = time() . "_" . basename($file_name);
            $target_file = $target_dir . $new_file_name;

            if (move_uploaded_file($tmp_name, $target_file)) {
                $profile_pic = $new_file_name;
            } else {
                echo "Failed to upload image. <a href='register.php'>Try again</a>";
                $upload_ok = false;
            }
        }
    }

    // Database Insertion ONLY if validation passes
    if ($upload_ok) {
        $query = "INSERT INTO users (username, email, password, profile_pic, role_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            $role_id = 2; // Default User Role
            mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $hashed_password, $profile_pic, $role_id);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "Registration successful! <a href='login.php'>Login here</a>";
            } else {
                echo "Execution Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Query Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
} else {
    header("Location: register.php");
    exit();
}
?>