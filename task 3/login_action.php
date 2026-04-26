<?php
/**
 * Login Action Handler
 * Purpose: Authenticate user credentials and redirect to dashboard.
 */

ob_start(); // Prevents header redirection errors
session_start();
require_once 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['login_btn'])) {
    // Trim and sanitize inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = trim($_POST['password']); 

    // 1. Fetch user record based on email using prepared statement
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            // 2. Verify the hashed password against the user input
            if (password_verify($password, $user['password'])) {
                
                // 3. Set Session variables for the logged-in user
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // 4. Redirect to Dashboard upon success
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid Password. <a href='login.php'>Try again</a>";
            }
        } else {
            echo "No account found with this email. <a href='register.php'>Register here</a>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: Could not prepare statement.";
    }
} else {
    // Redirect back if page is accessed without form submission
    header("Location: login.php");
    exit();
}

ob_end_flush();
?>