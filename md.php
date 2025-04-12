<?php
session_start();
include 'db.php'; // Include the database connection file

// Fetch all destinations from the database in ASCENDING order
$result = $conn->query("SELECT * FROM destinations ORDER BY created_time ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Indian Destinations</title>
     <link rel="stylesheet" href="md.css">
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

     <div class="container">
          <h2 class="destination-heading">Famous Indian Destinations</h2>
          <div class="grid">
               <?php while ($row = $result->fetch_assoc()): ?>
               <div class="destination" data-title="<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>"
                    data-image="admin/uploads/<?= htmlspecialchars($row['image'], ENT_QUOTES) ?>"
                    data-description="<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>"
                    onclick="showModal(this)">
                    <img src="admin/uploads/<?= htmlspecialchars($row['image'], ENT_QUOTES) ?>"
                         alt="<?= $row['name'] ?>">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
               </div>
               <?php endwhile; ?>
          </div>
     </div>

     <!-- Destination Modal -->
     <div id="destinationModal" class="modal">
          <div class="modal-content">
               <span class="close" onclick="closeModal()">&times;</span>
               <img id="modalImage" src="" alt="Destination Image">
               <h3 id="modalTitle"></h3>
               <p id="modalDescription"></p>
               <a href="mp.php">Book Now</a>
          </div>
     </div>

     <script>
     function showModal(element) {
          const title = element.dataset.title;
          const image = element.dataset.image;
          const description = element.dataset.description;

          document.getElementById("modalTitle").innerText = title;
          document.getElementById("modalImage").src = image;
          document.getElementById("modalDescription").innerText = description;
          document.getElementById("destinationModal").style.display = "flex";
     }

     function closeModal() {
          document.getElementById("destinationModal").style.display = "none";
     }

     window.onload = function() {
          document.getElementById("destinationModal").style.display = "none";
     };

     window.onclick = function(event) {
          let modal = document.getElementById("destinationModal");
          if (event.target === modal) {
               closeModal();
          }
     };
     </script>

</body>

</html>