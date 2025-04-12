<?php
session_start();
include 'db.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>WanderLust - Travel Agency</title>
     <link rel="stylesheet" href="style.css">
</head>

<body>
     <!-- Navbar -->
     <nav class="navbar">
          <div class="logo">WanderLust</div>
          <ul>
               <li><a href="#home">Home</a></li>
               <li><a href="#destinations">Destinations</a></li>
               <li><a href="#packages">Packages</a></li>
               <li><a href="#about">About Us</a></li>
               <li><a href="#contact">Contact Us</a></li>
               <li><a href="carRental.php">Car Rental</a></li>

               <?php if (isset($_SESSION['user_id'])): ?>
               <li><a href="logout.php" class="btn">Logout</a></li>
               <?php else: ?>
               <li><a href="login.php" class="btn">Login</a></li>
               <?php endif; ?>
          </ul>
     </nav>

     <!-- Home Section -->
     <section id="home">
          <div class="home-wrapper">
               <h1 class="home">Welcome to WanderLust</h1>
               <p class="home">Your ultimate travel companion</p>
          </div>
     </section>

     <!-- Destination Section -->
     <section id="destinations">
          <h2>Popular Destinations in India</h2>
          <div class="destination-grid">
               <div class="destination-card"
                    onclick="showModal('Taj Mahal, Agra', 'img/taj-mahal.jpg', 'The Taj Mahal is an ivory-white marble mausoleum in Agra, India.')">
                    <img src="img/taj-mahal.jpg" alt="Taj Mahal">
                    <p>Taj Mahal, Agra</p>
               </div>
               <div class="destination-card"
                    onclick="showModal('Jaipur, Rajasthan', 'img/jaipur.jpg', 'Jaipur, the Pink City, is known for its palaces and culture.')">
                    <img src="img/jaipur.jpg" alt="Jaipur">
                    <p>Jaipur, Rajasthan</p>
               </div>
               <div class="destination-card"
                    onclick="showModal('Manali, Himachal Pradesh', 'img/manali.jpg', 'Manali is a beautiful hill station in Himachal Pradesh.')">
                    <img src="img/manali.jpg" alt="Manali">
                    <p>Manali</p>
               </div>
               <div class="destination-card"
                    onclick="showModal('Goa Beaches', 'img/goa.jpg', 'Goa is known for its beautiful beaches and nightlife.')">
                    <img src="img/goa.jpg" alt="Goa Beach">
                    <p>Goa Beaches</p>
               </div>
          </div>
          <div class="btn-md">
               <button class="md-btn" onclick="window.location.href='md.php'">More Destinations</button>
          </div>
     </section>

     <!-- Destination Modal -->
     <div id="destinationModal" class="modal">
          <div class="modal-content">
               <span class="close" onclick="closeModal()">&times;</span>
               <img id="modalImage" src="" alt="Destination Image">
               <h3 id="modalTitle"></h3>
               <p id="modalDescription"></p>
          </div>
     </div>

     <!-- Popular Packages -->
     <section id="packages">
          <h2>Popular Packages in India</h2>
          <div class="package-grid">
               <div class="package-card">
                    <img src="img/shimla.jpg" alt="Honeymoon Package">
                    <p>Honeymoon Package - Shimla</p>
                    <a href="mp.php">Book Now</a>
               </div>
               <div class=" package-card">
                    <img src="img/rishikesh.jpeg" alt="Adventure Tour">
                    <p>Adventure Tour - Rishikesh</p>
                    <a href="mp.php">Book Now</a>
               </div>
               <div class="package-card">
                    <img src="img/Ooty1.webp" alt="Family Vacation">
                    <p>Family Vacation - Ooty</p>
                    <a href="mp.php">Book Now</a>
               </div>
               <div class="package-card">
                    <img src="img/andaman-nicobar.png" alt="Luxury Cruise">
                    <p>Luxury Cruise - Andaman Islands</p>
                    <a href="mp.php">Book Now</a>
               </div>
          </div>
          <div class="btn-mp">
               <button class="mp-btn" onclick="window.location.href='mp.php'">More Packages</button>

          </div>
     </section>

     <!-- About Us -->
     <section id="about">
          <div class="about">
               <h2 class="about-heading">
                    Discover Who We Are 🌍✨
               </h2>

               <div class="about-container">
                    <div class="about-card">
                         <p class="about-text">
                              At Wanderlust, we turn your travel dreams into reality. Whether you're looking for a
                              <strong>romantic getaway, a thrilling adventure, or a relaxing beach escape</strong>, we
                              craft unforgettable experiences tailored to your needs. Our expert team ensures every trip
                              is seamless, enjoyable, and stress-free.
                         </p>

                         <!-- Mission & Vision Section -->
                         <div class="about-mission">
                              <div class="mission-card">
                                   <h3>🌟 Our Mission</h3>
                                   <p>To create <strong>unforgettable travel experiences</strong> that inspire and bring
                                        people closer to different cultures and destinations.</p>
                              </div>

                              <div class="vision-card">
                                   <h3>🚀 Our Vision</h3>
                                   <p>To become the <strong>leading travel agency worldwide</strong>, known for
                                        innovation, affordability, and top-tier service.</p>
                              </div>
                         </div>

                         <!-- Key Features -->
                         <div class="about-features">
                              <div class="about-feature">
                                   <h3 class="feature-title">📍 Personalized Itineraries</h3>
                                   <p class="feature-text">Your journey, your way—custom travel plans crafted to match
                                        your style.</p>
                              </div>
                              <div class="about-feature">
                                   <h3 class="feature-title">🛫 Hassle-Free Booking</h3>
                                   <p class="feature-text">Seamless reservations with top travel deals and expert
                                        guidance.</p>
                              </div>
                              <div class="about-feature">
                                   <h3 class="feature-title">💰 Best Deals & Discounts</h3>
                                   <p class="feature-text">We bring you the best prices without compromising on quality.
                                   </p>
                              </div>
                              <div class="about-feature">
                                   <h3 class="feature-title">☎ 24/7 Customer Support</h3>
                                   <p class="feature-text">We’re here to assist you, anytime, anywhere.</p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <!-- Contact Us -->
     <section id="contact">
          <h2 class="contact-title">Contact Us</h2>
          <div class="contact-container">

               <div class="right-side">
                    <img src="img/contact.jpg" alt="contact us image" class="contact-image">
               </div>

               <div class="left-side">
                    <form>
                         <input type="text" name="name" placeholder="Your Name" required>
                         <input type="email" name="email" placeholder="Your Email" required>
                         <textarea name="message" placeholder="Your Message" required></textarea>
                         <button type="submit" class="contact-btn">Submit</button>
                    </form>
               </div>
          </div>
     </section>

     <!-- Footer -->
     <footer>
          <p>&copy; 2025 WanderLust. All rights reserved.</p>
     </footer>




     <script>
     const images = [
          'img/img1.jpg',
          'img/img2.jpg',
          'img/img3.jpg',
          'img/img4.jpg',
          'img/img5.jpg'
     ];

     let index = 0;

     function changeBackground() {
          document.getElementById("home").style.backgroundImage = `url('${images[index]}')`;
          document.getElementById("home").style.backgroundSize = "cover"; // Ensure it covers
          document.getElementById("home").style.backgroundPosition = "center"; // Center the image
          index = (index + 1) % images.length;
     }

     // Change the background every 4 seconds
     setInterval(changeBackground, 4000);
     changeBackground(); // Initial call



     function showModal(title, image, description) {
          document.getElementById("modalTitle").innerText = title;
          document.getElementById("modalImage").src = image;
          document.getElementById("modalDescription").innerText = description;
          document.getElementById("destinationModal").style.display = "flex";
     }

     function closeModal() {
          document.getElementById("destinationModal").style.display = "none";
     }

     // Prevent modal from displaying on page load
     window.onload = function() {
          document.getElementById("destinationModal").style.display = "none";
     };

     // Close modal when clicking outside
     window.onclick = function(event) {
          let modal = document.getElementById("destinationModal");
          if (event.target === modal) {
               closeModal();
          }
     };
     </script>

</body>

</html>