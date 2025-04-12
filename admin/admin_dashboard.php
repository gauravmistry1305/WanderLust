<?php
session_start();

require_once '../db.php'; // Include your database connection file

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Fetch total users
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// Fetch total users
$total_places = $conn->query("SELECT COUNT(*) AS total FROM destinations")->fetch_assoc()['total'];

// Fetch total trips
$total_trips = $conn->query("SELECT COUNT(*) AS total FROM trips")->fetch_assoc()['total'];

// Fetch total cars
$total_cars = $conn->query("SELECT COUNT(*) AS total FROM cars")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Admin Dashboard</title>
     <link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>

     <div class="sidebar">
          <h2>Admin Panel</h2>
          <a href="manage_users.php">👤 Manage Users</a>
          <a href="manage_destinations.php">🛣️ Manage Places</a>
          <a href="manage_trips.php">🧳 Manage Trips</a>
          <a href="manage_cars.php">🚗 Manage Cars</a>
          <a class="logout-link" href="admin_logout.php">🚪 Logout</a>
     </div>

     <div class="main-content">
          <div class="welcome-box">
               <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h1>
               <div class="alert" id="alert-box">
                    ✅ You are logged in to the secure admin dashboard. Use the sidebar to manage users, trips, and cars.
               </div>

               <!-- Stats Section -->
               <div class="stats-box">
                    <div class="stat-card">
                         <div class="stat-title">Total Users 👤</div>
                         <div class="stat-value"><?php echo $total_users; ?></div>
                    </div>
                    <div class="stat-card">
                         <div class="stat-title">Total Places 🛣️</div>
                         <div class="stat-value"><?php echo $total_places; ?></div>
                    </div>
                    <div class="stat-card">
                         <div class="stat-title">Total Trips 🧳</div>
                         <div class="stat-value"><?php echo $total_trips; ?></div>
                    </div>
                    <div class="stat-card">
                         <div class="stat-title">Total Cars 🚗</div>
                         <div class="stat-value"><?php echo $total_cars; ?></div>
                    </div>
               </div>
          </div>
     </div>

     <script>
     // Hide alert box after 3 seconds
     setTimeout(function() {
          var alertBox = document.getElementById('alert-box');
          if (alertBox) {
               alertBox.style.transition = "opacity 0.5s ease";
               alertBox.style.opacity = 0;
               setTimeout(() => alertBox.style.display = "none", 500);
          }
     }, 3000);
     </script>

</body>

</html>