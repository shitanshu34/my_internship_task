<?php
/**
 * Delete User Handler (CRUD - Delete)
 * Purpose: Securely delete a user from the database using Prepared Statements.
 */

session_start();
require_once 'config.php';

// 1. Security Check: Only logged-in users can delete
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Get ID from URL
if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];

    // 3. Prevent user from deleting themselves (Optional but safer)
    if ($id_to_delete == $_SESSION['user_id']) {
        echo "<script>alert('You cannot delete your own logged-in account!'); window.location='users_list.php';</script>";
        exit();
    }

    // 4. Prepared Statement to prevent SQL Injection
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_to_delete);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success: Redirect back to the list
            header("Location: users_list.php?msg=deleted");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
} else {
    header("Location: users_list.php");
    exit();
}
?>