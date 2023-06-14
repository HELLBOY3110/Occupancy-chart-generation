<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// Fetch booking data
$query = "SELECT * FROM stu_req";
$result = mysqli_query($connect, $query);

if ($result) {
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

  // Prepare the response
  $response = array("bookings" => $bookings);

  // Send the response as JSON
  header("Content-Type: application/json");
  echo json_encode($response);
} else {
  echo "Error: " . mysqli_error($connect);
}

mysqli_close($connect);
?>