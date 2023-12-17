<?php
$servername = "localhost"; // Replace with your actual database server name
$username = "root"; // Replace with your actual database username
$password = ""; // Replace with your actual database password
$dbname = "ATIWEB";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
