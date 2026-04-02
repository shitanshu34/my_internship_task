<?php 
// STEP 6.4: Include the header file
include 'header.php'; 

// STEP 6.1: PHP Variables & Arrays
$myName = "Shitanshu";
$skills = ["HTML5", "CSS3", "JavaScript", "PHP", "MySQL"]; // Indexed Array 

// STEP 6.3: Handling Form with $_POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor = $_POST['name'];
    echo "<script>alert('Hi $visitor, PHP is now handling your form!');</script>";
}
?>

<div style="padding: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h1>Welcome, I am <?php echo $myName; ?></h1> <h3>My Technical Skills (Generated via PHP Loop):</h3>
    <ul>
        <?php 
        // STEP 6.2: Using foreach loop 
        foreach($skills as $skill) {
            echo "<li style='margin-bottom: 8px;'>$skill</li>";
        }
        ?>
    </ul>

    <hr>

    <h3>Contact Me (Test PHP POST):</h3>
    <form method="POST" action="index.php">
        <input type="text" name="name" placeholder="Enter your name" required style="padding: 8px;">
        <button type="submit" style="padding: 8px 15px; background: #3498db; color: white; border: none; cursor: pointer;">
            Submit to PHP
        </button>
    </form>
</div>