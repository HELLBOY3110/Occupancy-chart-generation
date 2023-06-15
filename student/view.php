<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  // Fetch booking data
  $query = "SELECT * FROM stu_req";
  $result = mysqli_query($connect, $query);

  if (!$result) {
    die("Error: " . mysqli_error($connect));
  }

  $bookings = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
  }

  $response = array("bookings" => $bookings);
  echo json_encode($response);
}

mysqli_close($connect);
?>
