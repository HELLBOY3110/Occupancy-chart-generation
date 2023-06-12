<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];

    // Connect to your database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "stu_db";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the email exists in the database
    $query = "SELECT * FROM student WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Email exists, generate reset code and send email
        $resetCode = generateResetCode(); // Generate a random reset code
        $resetLink = "http://localhost/reset_password.php?code=" . urlencode($resetCode);
        $message = "Your password reset code is: $resetCode. Click the following link to reset your password: $resetLink";
        $subject = "Password Reset";

        // Configure PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = '19cse214.project@gmail.com'; // Replace with your Gmail email address
        $mail->Password = '19cse214!'; // Replace with your Gmail account password

        $mail->setFrom('19cse214.project@gmail.com', 'Aravinthan A'); // Replace with your name and Gmail email address
        $mail->addAddress($email);

        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo "Reset code has been sent to your email.";
        } else {
            echo "Failed to send reset code. Please try again.";
        }
    } else {
        // Email does not exist in the database
        echo "Email not found. Please enter a valid email address.";
    }

    mysqli_close($conn);
}

function generateResetCode() {
    // Generate a random reset code (e.g., a 6-digit code)
    return mt_rand(100000, 999999);
}
?>
