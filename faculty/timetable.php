<?php
error_reporting(0);

      // Database configuration
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "stu_db";

      // Create a database connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check the connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Function to generate the timetable based on subject code
      function generateTimetable($subjectCode, $conn) {
          // Fetch bookings for the given subject code
          $query = "SELECT * FROM bookings WHERE subject_code = '$subjectCode'";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              // Create a 2D array to store the timetable data
              $timetable = array();

              // Initialize the array with empty slots
              for ($i = 1; $i <= 5; $i++) {
                  $timetable[$i] = array("", "", "", "", "", "", "", "");
              }

              // Populate the timetable array with bookings data
              while ($row = $result->fetch_assoc()) {
                  $classroomNumber = $row['classroom_number'];
                  $slot = $row['slot'];
                  $day = $row['day'];

                  $timetable[$day][$slot] = $classroomNumber;
              }

              return $timetable;
          } else {
              return array(); // Return an empty timetable if no bookings found
          }
      }

      // Check if the form is submitted and subjectCode is provided
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subjectCode'])) {
          $subjectCode = $_POST['subjectCode'];
          $timetable = generateTimetable($subjectCode, $conn);

          if (!empty($timetable)) {
              // Display the timetable
              echo "<html>";
        echo "<head>";
        echo "<style>";
        echo "body {";
        echo "  display: flex;";
        echo "  justify-content: center;";
        echo "  align-items: center;";
        echo "  height: 100vh;";
        echo "  margin: 0;";
        echo "  padding: 0;";
        echo "}";
        echo "table {";
        echo "  border-collapse: collapse;";
        echo "}";
        echo "th, td {";
        echo "  border: 1px solid black;";
        echo "  padding: 8px;";
        echo "  background-color: transparent;";
        echo "  backdrop-filter: blur(10px);";
        echo "  box-shadow: 0 0 30px rgba(0, 0, 0, .5);";
        echo "}";
        echo ".container {";
        echo "  text-align: center;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
              echo "<table>";
              echo "<tr><th>Day/Slot</th><th>Slot 1</th><th>Slot 2</th><th>Slot 3</th><th>Slot 4</th><th>Slot 5</th><th>Slot 6</th><th>Slot 7</th><th>Slot 8</th></tr>";

              $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");

              foreach ($days as $day) {
                  echo "<tr>";
                  echo "<td>$day</td>";

                  for ($slot = 1; $slot <= 8; $slot++) {
                      echo "<td>" . $timetable[$day][$slot] . "</td>";
                  }

                  echo "</tr>";
              }
              echo "</table>";
        echo "<br>";
        echo "<a href='chart.html'>Back</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";

              echo "</table>";
          } else {
              echo "No bookings found for subject code $subjectCode.";
          }
      }

      // Close the database connection
      $conn->close();
      ?>
<html>
    <head></head>
    <body background="../1091574.png"></body>
</html>