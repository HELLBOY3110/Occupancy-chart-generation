<?php
// Connect to the database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "stu_db"; // Replace with your actual database name

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch feedback data from the database
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

// Create an array to store the feedback data
$feedbackData = array();

if ($result->num_rows > 0) {
    // Loop through each row and store the data in the array
    while ($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}

// Close the database connection
$conn->close();

// Send the feedback data as JSON response
header('Content-Type: application/json');
echo json_encode($feedbackData);
?>