<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('⚠️ You must be logged in to book a trip.'); window.location.href='login.php';</script>";
        exit;
    }

    $tripName = $_POST['tripName'];
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $phone = $_POST['phone'];
    $passengers = (int)$_POST['passengers'];
    $bookingDate = $_POST['bookingDate'];
    $basePrice = floatval($_POST['basePrice']);
    $totalPrice = $basePrice * $passengers;

    $stmt = $conn->prepare("INSERT INTO bookings (trip_name, user_name, user_email, phone, passengers, booking_date, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisd", $tripName, $userName, $userEmail, $phone, $passengers, $bookingDate, $totalPrice);

    if ($stmt->execute()) {
        $subject = "Booking Confirmation: $tripName";
        $message = "Dear $userName,\n\nThank you for booking '$tripName'.\nPassengers: $passengers\nDate: $bookingDate\nTotal Price: ₹" . number_format($totalPrice) . "\n\nWe'll contact you shortly!";
        $headers = "From: noreply@wanderlust.com";
        mail($userEmail, $subject, $message, $headers);

        echo "<script>alert('✅ Booking successful! Confirmation email sent.'); window.location.href='mp.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error storing booking. Please try again.');</script>";
    }
}

$searchTerm = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $searchTerm = $conn->real_escape_string(trim($_GET['search']));
    $result = $conn->query("SELECT * FROM trips WHERE name LIKE '%$searchTerm%' ORDER BY created_date DESC");
} else {
    $result = $conn->query("SELECT * FROM trips ORDER BY created_date DESC");
}
$packages = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Travel Packages</title>
     <link rel="stylesheet" href="mp.css">

     <style>
     .search-bar {
          display: flex;
          justify-content: center;
          margin: 20px auto;
          padding: 10px;
     }

     .search-bar form {
          display: flex;
          align-items: center;
          gap: 10px;
          background: #f1f1f1;
          padding: 10px 20px;
          border-radius: 30px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
     }

     .search-bar input[type="text"] {
          padding: 8px 14px;
          border: 1px solid #ccc;
          border-radius: 20px;
          font-size: 16px;
          width: 250px;
     }

     .search-bar button {
          padding: 8px 16px;
          background-color: #007BFF;
          color: #fff;
          border: none;
          border-radius: 20px;
          cursor: pointer;
          font-size: 16px;
          transition: background-color 0.3s ease;
     }

     .search-bar button:hover {
          background-color: #0056b3;
     }
     </style>
</head>

<body>

     <!-- Navbar -->
     <nav class="navbar">
          <div class="logo">WanderLust</div>
          <ul>
               <li><a href="index.php">Home</a></li>
               <li><a href="md.php">Destinations</a></li>
               <li><a href="mp.php">Packages</a></li>
               <li><a href="index.php">About Us</a></li>
               <li><a href="index.php">Contact Us</a></li>
               <li><a href="carRental.php">Car Rental</a></li>
               <?php if (isset($_SESSION['user_id'])): ?>
               <li><a href="logout.php" class="btn">Logout</a></li>
               <?php else: ?>
               <li><a href="login.php" class="btn">Login</a></li>
               <?php endif; ?>
          </ul>
     </nav>

     <!-- Centered Heading -->
     <h1 style="text-align: center;">Famous Packages In India</h1>

     <!-- Search Bar -->
     <div class="search-bar">
          <form method="GET" action="mp.php">
               <input type="text" name="search" placeholder="Search trip by name..."
                    value="<?php echo htmlspecialchars($searchTerm); ?>">
               <button type="submit">🔍 Search</button>
          </form>
     </div>

     <!-- Package Cards -->
     <div class="packages-container">
          <?php if (count($packages) > 0): ?>
          <?php foreach ($packages as $package): ?>
          <div class="package-card">
               <img src="./admin/uploads/<?php echo htmlspecialchars($package['image']); ?>"
                    alt="<?php echo htmlspecialchars($package['name']); ?>" class="package-image">
               <h3 class="package-title"><?php echo htmlspecialchars($package['name']); ?></h3>
               <p class="package-price">Price per person: ₹<?php echo number_format($package['price']); ?></p>
               <button
                    onclick="bookingForm('<?php echo addslashes($package['name']); ?>', <?php echo $package['price']; ?>)">Book
                    Now</button>
          </div>
          <?php endforeach; ?>
          <?php else: ?>
          <p style="text-align:center; font-size: 18px;">No travel packages available right now.</p>
          <?php endif; ?>
     </div>

     <!-- Modal -->
     <div id="bookingModal" class="modal" style="display:none;">
          <div class="modal-content">
               <span class="close" onclick="closeModal()">&times;</span>
               <h2>Book This Trip</h2>
               <form id="bookingForm" method="post">
                    <input type="hidden" id="tripName" name="tripName">
                    <input type="hidden" id="basePrice" name="basePrice">

                    <label>Trip Name:</label>
                    <input type="text" id="tripDisplay" disabled>

                    <label>Your Name:</label>
                    <input type="text" name="userName" required value="<?php echo $_SESSION['user_name'] ?? ''; ?>">

                    <label>Email:</label>
                    <input type="email" name="userEmail" required value="<?php echo $_SESSION['user_email'] ?? ''; ?>">

                    <label>Phone Number:</label>
                    <input type="text" name="phone" required pattern="[0-9]{10}">

                    <label>No. of Passengers:</label>
                    <input type="number" name="passengers" required min="1" max="10">

                    <label>Booking Date:</label>
                    <input type="date" name="bookingDate" required min="<?= date('Y-m-d') ?>">

                    <button type="submit" name="book">✅ Confirm Booking</button>
               </form>
          </div>
     </div>

     <script>
     const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

     function bookingForm(tripName, price) {
          if (!isLoggedIn) {
               alert("⚠️ Please login to book a trip.");
               window.location.href = "login.php";
               return;
          }

          document.getElementById("bookingModal").style.display = "flex";
          document.getElementById("tripName").value = tripName;
          document.getElementById("basePrice").value = price;
          document.getElementById("tripDisplay").value = tripName;
     }

     function closeModal() {
          document.getElementById("bookingModal").style.display = "none";
     }
     </script>

</body>

</html>