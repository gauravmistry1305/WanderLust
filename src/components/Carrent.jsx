import "./Carrent.css";
import CarNav from './CarNav';
import Footer from './Footer';
import {Link} from 'react-router-dom';

const Carrent = () => {
  return (
    <>
      <CarNav />
      <div className="hero">
        <div className="carhome">
          {/* Background Video */}
          <video autoPlay loop muted playsInline className="bg-video">
            <source src="./src/img/bgcarvideo.mp4" type="video/mp4" />
            Your browser does not support the video tag.
          </video>

          {/* Content on top of the video */}
          <div className="cartitle">
            <h1>FIND THE IDEAL CAR FOR YOU.</h1>
            <p>We provide the best rental cars at affordable prices.</p>
          </div>
        </div>
      </div>

      {/* Rental Benefits Section */}
      <section className="rental-benefits">
        <h2>Why Choose Our Car Rental Service?</h2>
        <div className="benefits-container">
          <div className="benefit">
            <img src="./src/img/easy_booking.jpg" alt="Easy Booking" />
            <h3>Easy Booking</h3>
            <p>Quick and hassle-free online booking with instant confirmation.</p>
          </div>
          <div className="benefit">
            <img src="./src/img/affordable.jpg" alt="Affordable Prices" />
            <h3>Affordable Prices</h3>
            <p>Competitive pricing with no hidden charges.</p>
          </div>
          <div className="benefit">
            <img src="./src/img/selection.jpg" alt="Wide Selection" />
            <h3>Wide Selection</h3>
            <p>Choose from a variety of cars, from economy to luxury.</p>
          </div>
          <div className="benefit">
            <img src="./src/img/service.jpg" alt="24/7 Support" />
            <h3>24/7 Customer Support</h3>
            <p>Our team is always available to assist you.</p>
          </div>
        </div>
      </section>

      {/* Featured Cars Section */}
      <section className="featured-cars">
        <h2>Our Featured Cars</h2>
        <div className="cars-container">
          <div className="car-card">
            <img src="./src/img/sedan.jpg" alt="Sedan Car" />
            <h3>Luxury Sedan</h3>
            <p>Comfortable & stylish, perfect for city rides.</p>
            <button><Link to="/cars">Rent Now</Link></button>
          </div>
          <div className="car-card">
            <img src="./src/img/suv1.jpg" alt="SUV Car" />
            <h3>Spacious SUV</h3>
            <p>Great for family trips & off-road adventures.</p>
            <button><Link to="/cars">Rent Now</Link></button>
          </div>
          <div className="car-card">
            <img src="./src/img/sports.jpg" alt="Sports Car" />
            <h3>Sports Car</h3>
            <p>High-speed performance for thrilling drives.</p>
            <button><Link to="/cars">Rent Now</Link></button>
          </div>
        </div>
      </section>

      {/* About Us Section */}
      <section className="about-us">
        <div className="about-container">
          <div className="about-image">
            <img src="./src/img/about.jpg" alt="About Us" />
          </div>
          <div className="about-content">
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

      <Footer />
    </>
  );
};

export default Carrent;
