<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $purpose = $_POST['Purpose'];
    $classroom = $_POST['classroom'];

    // Prepare and execute the SQL statement to insert the data into the database
    $sql = "INSERT INTO malfunction_requests (purpose, classroom) VALUES ('$purpose', '$classroom')";

    if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("Request submitted successfully.");';
        echo 'window.location.href = "request.html";';
        echo '</script>';
        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error: " . $sql . "<br>" . $conn->error;");';
        echo 'window.location.href = "request.html";';
        echo '</script>';
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
