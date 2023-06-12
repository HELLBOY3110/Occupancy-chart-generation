<?php
session_start(); // Start the session

$connect = mysqli_connect("localhost", "root", "", "stu_db") or die("Connection failed");

if (isset($_POST['username'])) {
  $ur_role = mysqli_real_escape_string($connect, $_POST['urrole']);
  $username_or_email = mysqli_real_escape_string($connect, $_POST['username']);
  $password = mysqli_real_escape_string($connect, $_POST['password']);

  // Check if the username_or_email field contains an "@" symbol to determine if it's an email
  $is_email = strpos($username_or_email, "@") !== false;

  if ($is_email) {
    // User provided an email, search by email in the database
    $query = "SELECT * FROM student WHERE role1='$ur_role' AND email='$username_or_email' AND password='$password'";
  } else {
    // User provided a username, search by username in the database
    $query = "SELECT * FROM student WHERE role1='$ur_role' AND username='$username_or_email' AND password='$password'";
  }

  $result = mysqli_query($connect, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    if ($status === 'pending') {
      echo "<script>alert('Your account is pending for approval.');</script>";
      header("Refresh:0; url=login.html");
      exit();
    } elseif ($status === 'approved') {
      $_SESSION["username"] = $row['username']; // Store the username in the session variable

      if ($ur_role === 'Student') {
        header("Location: /project/prject/student/stu-dash.html");
      } elseif ($ur_role === 'Admin') {
        header("Location: /project/prject/admin/admin.html");
      } elseif ($ur_role === 'Faculty') {
        header("Location: /project/prject/faculty/fac-dash.html");
      }
      exit();
    }
  } else {
    echo "<script>alert('Incorrect username or password!');</script>";
    header("Refresh:0; url=login.html");
    exit();
  }
}
?>
