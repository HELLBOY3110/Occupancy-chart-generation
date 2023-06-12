<?php
// Database connection configuration
$hostname = "localhost";
$username = "root";
$password = "";
$database = "stu_db"; // Replace with your actual database name

// Connect to the database
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $classroomNumber = $_POST["classnum"];
    $capacity = $_POST["classcap"];
    $type = $_POST["classtype"];
    
    // Prepare the query
    $query = "INSERT INTO classrooms (classroomNumber, capacity, type) 
              VALUES ('$classroomNumber', '$capacity', '$type')";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Classroom created successfully.";
    } else {
        echo "Failed to create classroom. Please try again.";
    }
}

// Close the connection
mysqli_close($conn);
?>
 <script>
    // Redirect back to the same page after 2 seconds
    setTimeout(function() {
      window.location.href = "room.html";
    }, 2000);
  </script>