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

// Fetch feedback data from the database
$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);

// Create an array to store the feedback data
$feedbackData = array();

if (mysqli_num_rows($result) > 0) {
    // Loop through each row and store the data in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $feedbackData[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);

// Send the feedback data as JSON response
header('Content-Type: application/json');
echo json_encode($feedbackData);
?>
