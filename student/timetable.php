<?php
error_reporting(0);

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

// Function to generate the timetable based on room number
function generateTimetable($roomNumber, $conn) {
    // Fetch bookings for the given room number
    $query = "SELECT * FROM bookings WHERE classroom_number = '$roomNumber'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Create a 2D array to store the timetable data
        $timetable = array();

        // Initialize the array with empty slots
        for ($i = 1; $i <= 5; $i++) {
            $timetable[$i] = array("", "", "", "", "", "", "", "");
        }

        // Populate the timetable array with bookings data
        while ($row = $result->fetch_assoc()) {
            $subjectCode = $row['subject_code'];
            $slot = $row['slot'];
            $day = $row['day'];

            $timetable[$day][$slot] = $subjectCode;
        }

        return $timetable;
    } else {
        return array(); // Return an empty timetable if no bookings found
    }
}

// Check if the form is submitted and roomNumber is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roomNumber'])) {
    $roomNumber = $_POST['roomNumber'];
    $timetable = generateTimetable($roomNumber, $conn);

    if (!empty($timetable)) {
        // Display the timetable
        echo "<html>";
        echo "<head>";
        echo "<style>";
        echo "table {";
        echo "  margin: 0 auto;";
        echo "  border-collapse: collapse;";
        echo "}";
        echo "th, td {";
        echo "  border: 1px solid black;";
        echo "  padding: 8px;";
        echo "}";
        echo ".container {";
        echo "  text-align: center;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<table>";
        echo "<tr><th>Day/Slot</th><th>Slot 1</th><th>Slot 2</th><th>Slot 3</th><th>Slot 4</th><th>Slot 5</th><th>Slot 6</th><th>Slot 7</th><th>Slot 8</th></tr>";

        $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");

        foreach ($days as $day) {
            echo "<tr>";
            echo "<td>$day</td>";

            for ($slot = 1; $slot <= 8; $slot++) {
                echo "<td>" . $timetable[$day][$slot] . "</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
        echo "<a href='timetable.html'>Back</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No bookings found for room number $roomNumber.";
    }
}

// Close the database connection
$conn->close();
?>
