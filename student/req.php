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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data
    $day = $_POST["day"];
    $timeslot = $_POST["slot"];
    $room = $_POST["room"];
    $subjectCode = $_POST["subjectCode"];

    // Check if the room is available for the given day and timeslot
    $checkQuery = "SELECT * FROM stu_req WHERE day = '$day' AND timeslot = $timeslot AND room_number = '$room'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Room is not available, display alert message
        echo '<script type="text/javascript">';
        echo 'alert("The selected room is not available for the given day and timeslot. Please choose a different room.");';
        echo 'window.location.href = "request.html";';
        echo '</script>';
        exit();
    } else {
        // Check if the subject code exists in the database
        $subjectQuery = "SELECT * FROM courses WHERE subjectCode = '$subjectCode'";
        $subjectResult = mysqli_query($conn, $subjectQuery);

        if (mysqli_num_rows($subjectResult) > 0) {
            // Room is available and subject code exists, proceed with the request submission

            // Prepare the SQL statement to insert the data into the table
            $status = "pending"; // Set the status to "pending"
            $query = "INSERT INTO stu_req (day, timeslot, room_number, subjectCode, status) VALUES ('$day', $timeslot, '$room', '$subjectCode', '$status')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo '<script type="text/javascript">';
                echo 'alert("Request has been successfully submitted.");';
                echo 'window.location.href = "request.html";';
                echo '</script>';
                exit();
            } else {
                echo "Failed to submit the request. Please try again.";
            }
        } else {
            // Subject code does not exist in the database, display an error message
            echo '<script type="text/javascript">';
            echo 'alert("Invalid subject code!");';
            echo 'window.location.href = "request.html";';
            echo '</script>';
            exit();
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
