<?php
$host = "localhost";  // Change if using a different host
$username = "root";   // Your database username
$password = "";       // Your database password (leave blank if none)
$database = "Wanderlust";  // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>