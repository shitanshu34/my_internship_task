<?php
/**
 * Database Configuration
 * Purpose: Establishing connection between PHP and MySQL
 */

// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "apex_internship";

// Create database connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/** * Note: Un-comment the line below only for testing. 
 * Remove it before final submission.
 */
// echo "Database Connected Successfully"; 
?>