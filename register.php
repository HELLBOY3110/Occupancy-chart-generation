<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stu_db";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register'])) {
    $ur_role = mysqli_real_escape_string($connect, $_POST['urrole']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Check if email already exists
    $select = "SELECT * FROM student WHERE email='$email'";
    $result = mysqli_query($connect, $select);
    if (mysqli_num_rows($result) > 0) {
        echo '<script type="text/javascript">';
        echo 'alert("Email Already taken!");';
        echo 'window.location.href = "login.html";';
        echo '</script>';
        exit();
    } else {
        // Insert the new user into the database
        $register = "INSERT INTO student (role1, username, email, password, status) VALUES ('$ur_role', '$username', '$email', '$password', 'pending')";

        if (mysqli_query($connect, $register)) {
            echo '<script type="text/javascript">';
            echo 'alert("Your account is now pending for approval!");';
            echo 'window.location.href = "login.html";';
            echo '</script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }
}

// Close the database connection
mysqli_close($connect);
?>
