<?php

session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package = $_POST['package'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $passengers = $_POST['passengers'];
    $price = $_POST['price'];
    $total_price = $_POST['total_price'];
    $date = $_POST['date'];

    // Save booking details to a file (Replace with a database in real projects)
    $file = fopen("bookings.txt", "a");
    fwrite($file, "Package: $package | Name: $name | Email: $email | Phone: $phone | Passengers: $passengers | Price per Person: $price | Total Price: $total_price | Date: $date\n");
    fclose($file);

    echo "<script>alert('Booking successful!'); window.location.href='mp.php';</script>";
} else {
    echo "<script>alert('Invalid request'); window.location.href='mp.php';</script>";
}
?>