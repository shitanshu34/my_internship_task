<?php
// Database connection ki details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// Connection banana (mysqli_connect ka use)
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check karna ki connection hua ya nahi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>