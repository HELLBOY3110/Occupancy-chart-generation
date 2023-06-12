<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  // Fetch student data
  $query = "SELECT * FROM student WHERE status = 'pending'";
  $result = mysqli_query($connect, $query);

  if (!$result) {
    die("Error: " . mysqli_error($connect));
  }

  $students = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
  }

  $response = array("students" => $students);
  echo json_encode($response);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Approve or deny student by updating the status or deleting the request
  $sno = $_POST["sno"];
  $action = $_POST["action"];

  if ($action === "approve") {
    $status = "approved";
    $updateQuery = "UPDATE student SET status = '$status' WHERE sno = '$sno'";
    $updateResult = mysqli_query($connect, $updateQuery);

    if ($updateResult) {
      $response = array("success" => true);
      echo json_encode($response);
    } else {
      $response = array("success" => false);
      echo json_encode($response);
    }
  } elseif ($action === "deny") {
    $deleteQuery = "DELETE FROM student WHERE sno = '$sno'";
    $deleteResult = mysqli_query($connect, $deleteQuery);

    if ($deleteResult) {
      $response = array("success" => true);
      echo json_encode($response);
    } else {
      $response = array("success" => false);
      echo json_encode($response);
    }
  }
}

mysqli_close($connect);
?>
