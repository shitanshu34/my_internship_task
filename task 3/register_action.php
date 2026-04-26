<?php
/**
 * Registration Action Handler
 * Purpose: Process user registration and save hashed passwords.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

if (isset($_POST['register_btn'])) {
    // Sanitize and trim inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']); // Added trim to remove accidental spaces

    // Secure password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Profile Picture Logic
    $profile_pic = "default.png";
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "uploads/";
        $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $file_name;
        }
    }

    // Database Insertion
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
    mysqli_close($conn);
} else {
    header("Location: register.php");
    exit();
}
?>