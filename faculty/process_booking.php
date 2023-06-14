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

// Test query to check database connection
$query = "SELECT 1";
$result = $conn->query($query);
if (!$result) {
    die("Database connection error: " . $conn->connect_error);
}

// Get form data
$subjectCode = $_POST['Purpose'];
$classroomNumber = $_POST['ClassroomNumber'];
$slot = $_POST['slot'];
$day = $_POST['day'];

// Prepare the SQL statement
$sql = "INSERT INTO bookings (subject_code, classroom_number, slot, day) VALUES ('$subjectCode', '$classroomNumber', '$slot', '$day')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Booking created successfully";
}
elseif ($conn->errno == 1062) {
    echo "This classroom is already booked for the same slot on the same day.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
