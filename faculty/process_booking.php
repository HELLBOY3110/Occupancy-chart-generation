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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $subjectCode = $_POST['Purpose'];
    $classroomNumber = $_POST['ClassroomNumber'];
    $slot = $_POST['slot'];
    $day = $_POST['day'];

    // Check if the course code is available
    $courseQuery = "SELECT * FROM courses WHERE courseCode = '$subjectCode'";
    $courseResult = $conn->query($courseQuery);
    
    if ($courseResult->num_rows > 0) {
        // Check if the classroom number exists
        $classroomQuery = "SELECT * FROM classrooms WHERE classroomNumber = '$classroomNumber'";
        $classroomResult = $conn->query($classroomQuery);
        
        if ($classroomResult->num_rows > 0) {
            // Prepare the SQL statement
            $sql = "INSERT INTO bookings (subject_code, classroom_number, slot, day) VALUES ('$subjectCode', '$classroomNumber', '$slot', '$day')";

            // Execute the SQL statement
            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/javascript">';
                echo 'alert("Booking created successfully");';
                echo 'window.location.href = "booking.html";';
                echo '</script>';
                exit(); // Add this line to stop executing the remaining code
            } elseif ($conn->errno == 1062) {
                echo '<script type="text/javascript">';
                echo 'alert("This classroom is already booked for the same slot on the same day.");';
                echo 'window.location.href = "booking.html";';
                echo '</script>';
                exit(); // Add this line to stop executing the remaining code
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Invalid classroom number!");';
            echo 'window.location.href = "booking.html";';
            echo '</script>';
            exit(); // Add this line to stop executing the remaining code
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Invalid course code!");';
        echo 'window.location.href = "booking.html";';
        echo '</script>';
        exit(); // Add this line to stop executing the remaining code
    }
}

// Close the database connection
$conn->close();
?>
