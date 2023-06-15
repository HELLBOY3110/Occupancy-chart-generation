<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create a database connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $purpose = $_POST['Purpose'];
    $classroom = $_POST['classroom'];
    $description = $_POST['description'];
    
    // Perform any necessary data validation
    
    // Check if the classroom exists in the database
    $classroomQuery = "SELECT * FROM classrooms WHERE classroomNumber = '$classroom'";
    $classroomResult = $connection->query($classroomQuery);
    
    if ($classroomResult->num_rows > 0) {
        // Insert the request into the database
        $query = "INSERT INTO requests (purpose, classroom, description) VALUES ('$purpose', '$classroom', '$description')";
        // Replace 'requests' with your actual table name
    
        // Execute the query
        if ($connection->query($query) === true) {
            // Request successfully inserted into the database
            // You can redirect the user to a success page or display a success message
            echo '<script type="text/javascript">';
            echo 'alert("Request submitted successfully");';
            echo 'window.location.href = "request.html";';
            echo '</script>';
            exit();
        } else {
            // Error occurred while inserting the request
            // You can redirect the user to an error page or display an error message
            echo '<script type="text/javascript">';
            echo 'alert("Error: ' . $connection->error . '");';
            echo 'window.location.href = "request.html";';
            echo '</script>';
            exit();
        }
    } else {
        // Classroom does not exist in the database
        // Display an error message
        echo '<script type="text/javascript">';
        echo 'alert("Invalid classroom number!");';
        echo 'window.location.href = "request.html";';
        echo '</script>';
        exit();
    }
}

// Close the database connection
$connection->close();
?>
