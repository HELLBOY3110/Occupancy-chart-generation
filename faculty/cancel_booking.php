<?php
// Retrieve the booking ID from the request
$bookingId = $_POST['bookingId'];

// Connect to the database (replace with your database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'stu_db';
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Delete the booking from the database
$sql = "DELETE FROM bookings WHERE id = $bookingId";

if ($conn->query($sql) === TRUE) {
    echo 'Booking deleted successfully';
} else {
    echo 'Error deleting booking: ' . $conn->error;
    echo 'SQL query: ' . $sql; // Debug line
}

$conn->close();
?>
