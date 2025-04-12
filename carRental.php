<?php
session_start();
include 'db.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Car Rental</title>
     <link rel="stylesheet" href="carRental.css">
</head>

<body>
     <!-- Navbar -->
     <nav class="navbar">
          <div class="logo">WanderLust</div>
          <ul>
               <li><a href="carRental.php">Home</a></li>
               <li><a href="cars.php">Cars</a></li>
               <li><a href=#about-car>About Us</a></li>
               <li><a href=#contact-car>Contact Us</a></li>
               <li><a href="index.php">Trip</a></li>

               <?php if (isset($_SESSION['user_id'])): ?>
               <!-- If user is logged in, show logout button -->
               <li><a href="logout.php" class="btn">Logout</a></li>
               <?php else: ?>
               <!-- If user is not logged in, show login button -->
               <li><a href="login.php" class="btn">Login</a></li>
               <?php endif; ?>
          </ul>
     </nav>

     <div class="hero">
          <div class="carhome">
               <video autoplay loop muted playsinline class="bg-video">
                    <source src="img/bgcarvideo.mp4" type="video/mp4">
                    Your browser does not support the video tag.
               </video>
               <div class="cartitle">
                    <h1>FIND THE IDEAL CAR FOR YOU.</h1>
                    <p>We provide the best rental cars at affordable prices.</p>
               </div>
          </div>
     </div>

     <section class="rental-benefits">
          <h2>Why Choose Our Car Rental Service?</h2>
          <div class="benefits-container">
               <div class="benefit">
                    <img src="img/easy_booking.jpg" alt="Easy Booking">
                    <h3>Easy Booking</h3>
                    <p>Quick and hassle-free online booking with instant confirmation.</p>
               </div>
               <div class="benefit">
                    <img src="img/affordable.jpg" alt="Affordable Prices">
                    <h3>Affordable Prices</h3>
                    <p>Competitive pricing with no hidden charges.</p>
               </div>
               <div class="benefit">
                    <img src="img/selection copy.jpg" alt="Wide Selection">
                    <h3>Wide Selection</h3>
                    <p>Choose from a variety of cars, from economy to luxury.</p>
               </div>
               <div class="benefit">
                    <img src="img/service.jpg" alt="24/7 Support">
                    <h3>24/7 Customer Support</h3>
                    <p>Our team is always available to assist you.</p>
               </div>
          </div>
     </section>

     <section class="featured-cars">
          <h2>Our Featured Cars</h2>
          <div class="car-container">
               <div class="car-card">
                    <img src="img/sedan.jpg" alt="Sedan Car">
                    <h3>Luxury Sedan</h3>
                    <p>Comfortable & stylish, perfect for city rides.</p>
                    <button><a href="cars.php">Rent Now</a></button>
               </div>
               <div class="car-card">
                    <img src="img/suv1.jpg" alt="SUV Car" height="173px">
                    <h3>Spacious SUV</h3>
                    <p>Great for family trips & off-road adventures.</p>
                    <button><a href="cars.php">Rent Now</a></button>
               </div>
               <div class="car-card">
                    <img src="img/sports copy.jpg" alt="Sports Car">
                    <h3>Sports Car</h3>
                    <p>High-speed performance for thrilling drives.</p>
                    <button><a href="cars.php">Rent Now</a></button>
               </div>
          </div>
     </section>

     <section id="about-car">
          <section class="about-us">
               <div class="about-container">
                    <div class="about-image">
                         <img src="img/about.jpg" alt="About Us">
                    </div>
                    <div class="about-content">
                         <h2>About Us</h2>
                         <p>
                              At <strong>WanderLust Car Rentals</strong>, we are committed to providing the best rental
                              experience with a vast range of vehicles suited for every need. Whether you’re looking
                              for a compact city car, a spacious SUV, or a luxury ride, we have you covered.
                         </p>
                         <p>
                              Our mission is to make car rentals convenient, affordable, and hassle-free,
                              ensuring your journey is smooth and enjoyable. With 24/7 customer support
                              and well-maintained vehicles, we guarantee the best travel experience.
                         </p>
                    </div>
               </div>
          </section>
     </section>


     <!-- Contact Us -->
     <section id="contact-car">
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
</body>

</html>