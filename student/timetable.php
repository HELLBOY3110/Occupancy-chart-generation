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
        // Create a 2D array to store the timetable data
        $timetable = array();

        // Initialize the array with empty slots
        for ($i = 1; $i <= 5; $i++) {
            for ($j = 1; $j <= 8; $j++) {
                $timetable[$i][$j] = "";
            }
        }

        // Populate the timetable array with bookings data
        while ($row = $result->fetch_assoc()) {
            $subjectCode = $row['subject_code'];
            $slot = $row['slot'];
            $day = $row['day'];

            $timetable[$day][$slot] = $subjectCode;
        }

        // Display the timetable
        echo "<table>";
        echo "<tr><th>Day/Slot</th>";

        for ($i = 1; $i <= 8; $i++) {
            echo "<th>Slot $i</th>";
        }

        echo "</tr>";

        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");

        for ($i = 1; $i <= 5; $i++) {
            echo "<tr>";
            echo "<td>" . $days[$i-1] . "</td>";

            for ($j = 1; $j <= 8; $j++) {
                echo "<td>" . $timetable[$i][$j] . "</td>";
            }

            echo "</tr>";
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
