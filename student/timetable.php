<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the roomNumber variable
$roomNumber = "";

// Check if the form is submitted and roomNumber is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roomNumber'])) {
    // Get the input room number
    $roomNumber = $_POST['roomNumber'];

    // Fetch bookings for the given room number
    $query = "SELECT * FROM bookings WHERE classroom_number = '$roomNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Bookings found, display the timetable
        echo "<table>";
        echo "<tr><th>Subject Code</th><th>Slot</th><th>Day</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $subjectCode = $row['subject_code'];
            $slot = $row['slot'];
            $day = $row['day'];

            echo "<tr><td>$subjectCode</td><td>$slot</td><td>$day</td></tr>";
        }

        echo "</table>";
    } else {
        // No bookings found for the given room number
        echo "No bookings found for room number $roomNumber.";
    }
}

// Close the database connection
$conn->close();
?>
