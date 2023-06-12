<?php
// Connect to your database
$host = 'localhost';
$dbname = 'stu_db';
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Retrieve data from the bookings table
$query = "SELECT slot, classroom_number FROM bookings";
$stmt = $conn->prepare($query);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convert the data to JSON
$jsonData = json_encode($bookings);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonData;
?>
