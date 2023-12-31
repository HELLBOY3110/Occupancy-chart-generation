<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];

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

  // Fetch student's name from the database
  $query = "SELECT name FROM student WHERE username = '$username'";
  $result = mysqli_query($connect, $query);

  if (!$result) {
    die("Query error: " . mysqli_error($connect));
  }
  
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $studentName = $row["name"];
  } else {
    $studentName = "Unknown";
  }
  
  mysqli_close($connect);
  
} else {
  // Redirect the user to the login page if not logged in
  header("Location: ../login.html");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="stu-dash.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="./pic/logo.jpg">
          <span class="nav-item">DASHBOARD</span>
        </a></li>
        <li><a href="request.html">
          <i class="fas fa-hands-helping"></i>
          <span class="nav-item">Request</span>
        </a></li>
        <li><a href="view.html">
          <i class="fas fa-clipboard"></i>
          <span class="nav-item">View or Cancel</span>
        </a></li>
        <li><a href="timetable.html">
          <i class="fas fa-calendar-alt"></i>
          <span class="nav-item">Timetable</span>
        </a></li>
        <li class="logout"><a href="#" onclick="logout()">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Logout</span>
        </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>Welcome</h1>
      </div>
      <div class="users">
        <div class="card">
          <img src="./pic/img1.jpg">
          <h4><span id="student-name"><?php echo $studentName; ?></span></h4>
          <p>CB.EN.U4CSE20320</p>
        </div>
      </div>
      <div class="wrapper">
        <h2>Notifications</h2>
        
      </div>
    </section>
  </div>
  <script>
    function logout() {
      // Add your logout logic here
      // For example, redirect the user to the login page
      window.location.href = "../login.html";
    }
  </script>
</body>
</html>
