<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_destroy();

// Redirect to the homepage (or login page) after logout
header("Location: index.php"); // Change "index.php" to your homepage or login page
exit();
?>