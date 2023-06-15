<?php
// delete_request.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_id'])) {
  // Retrieve the request ID from the POST data
  $requestId = $_POST['request_id'];

  // Connect to your database
  $dbHost = "localhost";
  $dbUser = "root";
  $dbPass = '';
  $dbName = "stu_db";

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute the DELETE query
  $stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
  $stmt->bind_param("i", $requestId); // Assuming the ID column is of type INT, use "i" for integer
  $stmt->execute();

  $stmt->close();
  $conn->close();

  // Return a response to the AJAX request (optional)
  echo "success";
}
?>
