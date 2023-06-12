<?php
session_start(); // Start the session

// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];

  // Fetch student's name from the database
  $query = "SELECT name FROM students WHERE username = '$username'";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $studentName = $row["name"];
  } else {
    $studentName = "Unknown";
  }
} else {
  // Redirect the user to the login page if not logged in
  header("Location: ../login.html");
  exit();
}

mysqli_close($connect);
?>