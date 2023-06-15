<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the request ID and action from the request body
  $requestId = $_POST["requestId"];
  $action = $_POST["action"];

  // Perform the necessary actions based on the action
  if ($action === "approve") {
    // Update the status of the request to "Approved" in the database
    $updateQuery = "UPDATE stu_req SET status = 'Approved' WHERE id = '$requestId'";
    $updateResult = mysqli_query($connect, $updateQuery);

    if ($updateResult) {
      echo "Request approved";
    } else {
      echo "Failed to approve the request";
    }
  } elseif ($action === "reject") {
    // Delete the request data from the database
    $deleteQuery = "DELETE FROM stu_req WHERE id = '$requestId'";
    $deleteResult = mysqli_query($connect, $deleteQuery);

    if ($deleteResult) {
      echo "Request rejected";
    } else {
      echo "Failed to reject the request";
    }
  }
} else {
  // Check if the request is a GET request
  if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Retrieve the room requests from the database
    $selectQuery = "SELECT * FROM stu_req";
    $selectResult = mysqli_query($connect, $selectQuery);

    if ($selectResult) {
      $roomRequests = array();
      while ($row = mysqli_fetch_assoc($selectResult)) {
        $roomRequests[] = $row;
      }
      echo json_encode($roomRequests);
    } else {
      echo "Failed to retrieve room requests";
    }
  }
}
// Close the database connection
mysqli_close($connect);
?>
