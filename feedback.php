<?php
// Connect to the database

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname = "localhost";
$username = "root";
$password = "";
$database = "stu_db"; // Replace with your actual database name

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['feedback'])) {
       // Retrieve form data
       $name = $_POST["name"];
       $email = $_POST["email"];
       $userType = $_POST["user-type"];
       $category = $_POST["category"];
       $message = $_POST["message"];
   
    // Prepare the query
    $query = "INSERT INTO feedback (name, email, userType, category, msg) 
          VALUES ('$name', '$email', '$userType', '$category', '$message')";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Failed to submit feedback. Please try again." ;
    }
}

// Close the connection
mysqli_close($conn);
?>