<?php

session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name = $_POST['package_name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $people = $_POST['people'];
    $date = $_POST['date'];

    // Basic Validation
    if (empty($name) || empty($email) || empty($phone) || empty($people) || empty($date)) {
        echo "All fields are required!";
        exit;
    }

    // Save Booking (You can replace this with a database insertion)
    $booking_data = "Package: $package_name | Name: $name | Email: $email | Phone: $phone | People: $people | Date: $date\n";
    file_put_contents("bookings.txt", $booking_data, FILE_APPEND);

    // Redirect back with success message
    echo "<script>alert('Booking Successful!'); window.location.href='mp.php';</script>";
} else {
    echo "Invalid request.";
}
?>