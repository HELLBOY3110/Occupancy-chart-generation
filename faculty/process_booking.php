<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$purpose = $_POST['Purpose'];
$classroomNumber = $_POST['Classroom_Number'];
$slot = $_POST['slot'];

// Prepare the SQL statement
$sql = "INSERT INTO bookings (purpose, classroom_number, slot) VALUES ('$purpose', '$classroomNumber', '$slot')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Booking created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
