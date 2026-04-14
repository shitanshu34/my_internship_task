<?php
// Professional way to handle dummy AJAX request
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Dummy logic: only this email is considered "taken"
    if ($email === "test@gmail.com") {
        echo "exists";
    } else {
        echo "available";
    }
}
?>