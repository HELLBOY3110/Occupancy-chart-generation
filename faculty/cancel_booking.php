<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the booking ID from the form submission
  $bookingId = $_POST["bookingId"];

  // Delete the booking from the database
  $query = "DELETE FROM bookings WHERE id = '$bookingId'";
  $result = mysqli_query($connect, $query);

  if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Booking Cancelled successfully");';
        echo 'window.location.href = "booking.html";';
        echo '</script>';
        exit();
  } else {
        echo '<script type="text/javascript">';
        echo 'alert("error in cancell booking");. mysqli_error($connect);';
        echo 'window.location.href = "booking.html";';
        echo '</script>';
  }
}

mysqli_close($connect);
?>

