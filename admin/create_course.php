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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $courseName = mysqli_real_escape_string($conn, $_POST["courseName"]);
    $faculty = mysqli_real_escape_string($conn, $_POST["faculty"]);
    $courseCode = mysqli_real_escape_string($conn, $_POST["courseCode"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    // Prepare the query
    $query = "INSERT INTO courses (courseName, faculty, courseCode, description) 
              VALUES ('$courseName', '$faculty', '$courseCode', '$description')";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Created course Successfully");';
        echo 'window.location.href = "course.html";';
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Failed to create course. Please try again.");';
        echo 'window.location.href = "course.html";';
        echo '</script>';
        exit();
    }
}

// Close the connection
mysqli_close($conn);
?>

