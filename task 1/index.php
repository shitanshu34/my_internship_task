<?php 
// STEP 6.4: Include the header file
include 'header.php'; 

// STEP 7.5: Include Database Connection
include 'db_connect.php'; 

// STEP 6.1: PHP Variables & Arrays
$myName = "Shitanshu";
$skills = ["HTML5", "CSS3", "JavaScript", "PHP", "MySQL"]; 

// STEP 6.3 & 7.3: Handling Form & Saving to MySQL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizing input for basic security
    $visitor = htmlspecialchars($_POST['name']);
    
    // SQL Query to insert data
    $sql = "INSERT INTO contacts (name) VALUES ('$visitor')";

    if (mysqli_query($conn, $sql)) {
        // Professional English Alert
        echo "<script>alert('Success! Thank you $visitor, your data has been saved successfully.');</script>";
    } else {
        // Professional Error Message
        echo "<script>alert('Error: Unable to save data. Please try again.');</script>";
    }
}
?>

<div style="padding: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h1>Welcome, I am <?php echo $myName; ?></h1> 
    <h3>Technical Skills (Dynamic PHP List):</h3>
    <ul>
        <?php 
        // STEP 6.2: Using foreach loop 
        foreach($skills as $skill) {
            echo "<li style='margin-bottom: 8px;'>$skill</li>";
        }
        ?>
    </ul>

    <hr>

    <h3>Contact Form (PHP & MySQL Integration):</h3>
    <form method="POST" action="index.php">
        <input type="text" name="name" placeholder="Enter your full name" required style="padding: 10px; width: 250px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="padding: 10px 20px; background: #2c3e50; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            Submit Request
        </button>
    </form>
</div>