<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin-dash.css">
  <link rel="stylesheet" href="course.css">
  <!-- Font Awesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="admin.html" class="logo">
            <img src="./pic/logo.jpg" alt="Logo">
            <span class="nav-item">DASHBOARD</span>
          </a>
        </li>
        <li>
          <a href="course.html">
            <i class="fas fa-book"></i>
            <span class="nav-item">Create Course</span>
          </a>
        </li>
        <li>
          <a href="approve.html">
            <i class="fas fa-hands-helping"></i>
            <span class="nav-item">Approve Credentials</span>
          </a>
        </li>
        <li>
          <a href="room.html">
            <i class="fas fa-school"></i>
            <span class="nav-item">Create Classroom</span>
          </a>
        </li>
        <li>
          <a href="req_room.html">
            <i class="fas fa-check-circle"></i>
            <span class="nav-item">Room Request</span>
          </a>
        </li>
        <li>
          <a href="malfunc.php">
            <i class="fas fa-wrench"></i>
            <span class="nav-item">Malfunction Requests</span>
          </a>
        </li>
        <li>
          <a href="view_feed.html">
            <i class="fas fa-book"></i>
            <span class="nav-item">View Feedback</span>
          </a>
        </li>
        <li class="logout">
          <a href="#" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <div class="main1">
      <h1>Classroom Malfunction Requests</h1>
      <table>
        <thead>
          <tr>
            <th>Request ID</th>
            <th>Classroom Number</th>
            <th>Object</th>
            <th>Problem</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Connect to your database and retrieve data from the "requests" table
          $dbHost = "localhost";
          $dbUser = "root";
          $dbPass = '';
          $dbName = "stu_db";

          $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM requests";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["classroom"] . "</td>";
              echo "<td>" . $row["purpose"] . "</td>";
              echo "<td>" . $row["description"] . "</td>";
              echo "<td>";
              echo "<button class='done-btn' onclick='deleteRequest(" . $row["id"] . ")'>Done</button>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No malfunction requests found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
    // Logout function
    function logout() {
      // Add your logout logic here
      // For example, redirect the user to the login page
      window.location.href = "../login.html";
    };

// Delete request function
function deleteRequest(requestId) {
  // Send a fetch request to delete_request.php
  fetch("delete_request.php", {
    method: "POST",
    headers: {
      "Content-type": "application/x-www-form-urlencoded"
    },
    body: "request_id=" + requestId
  })
  .then(response => {
    // Upon successful deletion, remove the corresponding row from the table
    var row = document.getElementById(requestId);
    row.parentNode.removeChild(row);

    // Refresh the page
    window.location.reload();
  })
  .catch(error => {
    console.error("Error deleting request:", error);
  });
}
  </script>
</body>

</html>
