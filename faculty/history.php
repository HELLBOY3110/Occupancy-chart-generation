<?php
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

// Retrieve bookings from the database
$query = "SELECT * FROM bookings";
$result = mysqli_query($connect, $query);

if (!$result) {
  die("Error: " . mysqli_error($connect));
}

$bookings = array();
while ($row = mysqli_fetch_assoc($result)) {
  $bookings[] = $row;
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Bookings</title>
  <link rel="stylesheet" href="fac-dash.css">
  <link rel="stylesheet" href="booking.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- Add your CSS stylesheets here --><style>
    /* Inline styles for the modified HTML structure */
    .main1 {
      position: relative;
      padding: 20px;
      width: 750px;
      height: 350px;
      margin: 30px auto;
      background-color: transparent;
      text-align: center;
      border-radius: 20px;
      backdrop-filter: blur(20px);
      box-shadow: 0 0 30px rgba(0, 0, 0, .5);
      transform: translateY(50px);
    }

    .table-container {
      height: 100%;
      overflow-y: auto;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      margin-top: 20px;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    td button {
      padding: 5px 10px;
      background-color: #e74c3c;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    td button:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>
<div class="container">
    <nav>
      <ul>
        <li>
          <a href="fac-dash.html" class="logo">
            <img src="./pic/logo.jpg">
            <span class="nav-item">DASHBOARD</span>
          </a>
        </li>
        <li><a href="booking.html">
            <i class="fas fa-book"></i>
            <span class="nav-item">Booking</span>
          </a></li>
        <li><a href="history.php">
            <i class="fas fa-history	"></i>
            <span class="nav-item">View or cancel</span>
          </a></li>
        <li><a href="request.html">
            <i class="fas fa-chalkboard-teacher"></i>
            <span class="nav-item">Request</span>
          </a></li>
        <li><a href="generate chart.html">
            <i class="fas fa-calendar-alt"></i>
            <span class="nav-item">Generate Chart</span>
          </a></li>
        <li class="logout"><a href="#" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Logout</span>
          </a></li>
      </ul>
    </nav>

    <section class="main">
      <h1>View Bookings</h1>
      <table>
        <tr>
          <th>Booking ID</th>
          <th>Slot</th>
          <th>Classroom Number</th>
          <th>Day</th>
          <th>Action</th>
        </tr>
        <?php foreach ($bookings as $booking) : ?>
          <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['slot']; ?></td>
            <td><?php echo $booking['classroom_number']; ?></td>
            <td><?php echo $booking['day']; ?></td>
            <td>
              <form action="cancel_booking.php" method="POST">
                <input type="hidden" name="bookingId" value="<?php echo $booking['id']; ?>">
                <button type="submit" name="cancel">Cancel</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?> 
      </table>
  </div>  
</body>
</html>
