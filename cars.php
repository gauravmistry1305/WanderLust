<?php
session_start();
include 'db.php'; // Database connection

// Handle car booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_car'])) {
    $carName = $_POST['carName'];
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $phone = $_POST['phone'];
    $days = (int)$_POST['days'];
    $bookingDate = $_POST['bookingDate'];
    $basePrice = floatval($_POST['basePrice']);
    $totalPrice = $basePrice * $days;

    $stmt = $conn->prepare("INSERT INTO car_bookings (car_name, user_name, user_email, phone, days, booking_date, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisd", $carName, $userName, $userEmail, $phone, $days, $bookingDate, $totalPrice);

    if ($stmt->execute()) {
        $subject = "Car Booking Confirmation: $carName";
        $message = "Dear $userName,\n\nThank you for booking '$carName'.\nDays: $days\nDate: $bookingDate\nTotal Price: ₹" . number_format($totalPrice) . "\n\nWe'll contact you soon!";
        $headers = "From: noreply@wanderlust.com";
        mail($userEmail, $subject, $message, $headers);

        echo "<script>alert('✅ Car booking successful! Confirmation email sent.'); window.location.href='cars.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error storing car booking. Please try again.');</script>";
    }
}

// Fetch cars with optional search
$carDatas = [];
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $stmt = $conn->prepare("SELECT name, brand, price_per_day, image, specs FROM cars WHERE name LIKE ? OR brand LIKE ? ORDER BY created_at DESC");
    $searchTerm = '%' . $search . '%';
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT name, brand, price_per_day, image, specs FROM cars ORDER BY created_at DESC");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carDatas[] = [
            'name' => $row['name'],
            'brand' => $row['brand'],
            'price' => $row['price_per_day'],
            'image' => $row['image'],
            'specs' => $row['specs']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ahmedabad Car Rentals</title>
     <link rel="stylesheet" href="cars.css">
</head>

<body>
     <nav class="navbar">
          <div class="logo">WanderLust</div>
          <ul>
               <li><a href="carRental.php">Home</a></li>
               <li><a href="carRental.php#about-car">About Us</a></li>
               <li><a href="carRental.php#contact-car">Contact Us</a></li>
               <li><a href="index.php">Trips</a></li>
               <?php if (isset($_SESSION['user_id'])): ?>
               <li><a href="logout.php" class="btn">Logout</a></li>
               <?php else: ?>
               <li><a href="login.php" class="btn">Login</a></li>
               <?php endif; ?>
          </ul>
     </nav>

     <div class="cars-container">
          <h2 class="car-heading">Available Cars from Ahmedabad</h2>

          <!-- Search Bar -->
          <form method="GET" action="cars.php" style="text-align:center; margin-bottom: 30px;">
               <input type="text" name="search" placeholder="🔍 Search by car name or brand..."
                    value="<?php echo htmlspecialchars($search); ?>"
                    style="padding:10px; width:300px; border-radius:6px; border:1px solid #ccc; font-size:16px; margin-right:5px;">
               <button type="submit"
                    style="padding:10px 15px; border:none; background-color:#007BFF; color:white; font-size:16px; border-radius:6px; cursor:pointer;">Search</button>
          </form>

          <!-- No result message -->
          <?php if (count($carDatas) === 0): ?>
          <p style="text-align:center; color:red; font-size:18px;">❌ No cars found for
               "<?php echo htmlspecialchars($search); ?>"</p>
          <?php endif; ?>

          <div class="cars-grid">
               <?php foreach ($carDatas as $carData) { ?>
               <div class="car-card">
                    <img src="./admin/uploads/<?php echo $carData['image']; ?>" alt="<?php echo $carData['name']; ?>"
                         class="car-image">
                    <h3 class="car-title"><?php echo $carData['name']; ?></h3>
                    <p class="car-specs"><?php echo $carData['specs']; ?></p>
                    <p class="car-price">Price per day: ₹<?php echo number_format($carData['price']); ?></p>
                    <button
                         onclick="openCarBooking('<?php echo addslashes($carData['name']); ?>', <?php echo $carData['price']; ?>)">Book
                         Now</button>
               </div>
               <?php } ?>
          </div>
     </div>

     <!-- Booking Modal -->
     <div id="carBookingModal" class="modal" style="display:none;">
          <div class="modal-content">
               <span class="close" onclick="closeModal()">&times;</span>
               <h2>Book This Car</h2>
               <form method="post">
                    <input type="hidden" id="carName" name="carName">
                    <input type="hidden" id="basePrice" name="basePrice">

                    <label>Car Name:</label>
                    <input type="text" id="carDisplay" disabled>

                    <label>Your Name:</label>
                    <input type="text" name="userName" required value="<?php echo $_SESSION['user_name'] ?? ''; ?>">

                    <label>Email:</label>
                    <input type="email" name="userEmail" required value="<?php echo $_SESSION['user_email'] ?? ''; ?>">

                    <label>Phone Number:</label>
                    <input type="text" name="phone" required pattern="[0-9]{10}">

                    <label>Booking Date (Start):</label>
                    <input type="date" name="bookingDate" id="bookingDate" required>

                    <label>Return Date:</label>
                    <input type="date" name="returnDate" id="returnDate" required>

                    <label>No. of Days:</label>
                    <input type="number" name="days" id="daysInput" required readonly>

                    <p id="totalPriceDisplay" style="font-weight:bold; color:white;">Total Price: ₹0</p>

                    <button type="submit" name="book_car">✅ Confirm Booking</button>
               </form>
          </div>
     </div>

     <script>
     const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

     function openCarBooking(name, price) {
          if (!isLoggedIn) {
               alert("⚠️ You need to log in to book a car.");
               window.location.href = "login.php";
               return;
          }

          document.getElementById('carBookingModal').style.display = 'flex';
          document.getElementById('carName').value = name;
          document.getElementById('basePrice').value = price;
          document.getElementById('carDisplay').value = name;

          document.getElementById('totalPriceDisplay').textContent = "Total Price: ₹0";
          document.getElementById('daysInput').value = "";
          document.getElementById('bookingDate').value = "";
          document.getElementById('returnDate').value = "";
     }

     function closeModal() {
          document.getElementById('carBookingModal').style.display = 'none';
     }

     document.addEventListener("DOMContentLoaded", function() {
          const bookingDateInput = document.getElementById('bookingDate');
          const returnDateInput = document.getElementById('returnDate');
          const daysInput = document.getElementById('daysInput');
          const totalDisplay = document.getElementById('totalPriceDisplay');

          const today = new Date().toISOString().split('T')[0];
          bookingDateInput.setAttribute("min", today);

          function calculateDays() {
               const start = new Date(bookingDateInput.value);
               const end = new Date(returnDateInput.value);
               const pricePerDay = parseFloat(document.getElementById('basePrice').value);

               if (!isNaN(start) && !isNaN(end) && end >= start) {
                    const diffTime = end - start;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    daysInput.value = diffDays;

                    const totalPrice = pricePerDay * diffDays;
                    totalDisplay.textContent = "Total Price: ₹" + totalPrice.toLocaleString('en-IN');
               } else {
                    daysInput.value = '';
                    totalDisplay.textContent = "Total Price: ₹0";
               }
          }

          bookingDateInput.addEventListener('change', function() {
               returnDateInput.value = '';
               returnDateInput.min = bookingDateInput.value;
               calculateDays();
          });

          returnDateInput.addEventListener('change', function() {
               if (returnDateInput.value < bookingDateInput.value) {
                    alert("Return date cannot be before booking date.");
                    returnDateInput.value = '';
                    daysInput.value = '';
                    totalDisplay.textContent = "Total Price: ₹0";
               } else {
                    calculateDays();
               }
          });
     });
     </script>
</body>

</html>