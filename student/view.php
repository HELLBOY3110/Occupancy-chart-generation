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
    $booking = array(
      "bookingId" => $row["bookingId"],
      "date" => $row["date"],
      "timeslot" => $row["timeslot"],
      "room_num" => $row["room_num"],
      "reason" => $row["reason"]
    );
    $bookings[] = $booking;
  }

  // Return JSON response
  $response = array("bookings" => $bookings);
  header("Content-type: application/json");
  echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Cancel booking
  $bookingId = $_POST["bookingId"];

  // Perform cancellation logic here
  $query = "DELETE FROM stu_req WHERE bookingId = '$bookingId'";
  $result = mysqli_query($connect, $query);

  if ($result) {
    // Booking canceled successfully
    $response = array("success" => true);
  } else {
    // Failed to cancel the booking
    $response = array("success" => false);
  }

  // Return JSON response
  header("Content-type: application/json");
  echo json_encode($response);
}

mysqli_close($connect);
?>
