import { motion } from "framer-motion";
import './Aboutus.css';
// import { div } from "framer-motion/client";

const AboutUs = () => {
  return (
    <div className="about">
      <h2>Discover who we are :)</h2>
    <div className="about-container">
      <motion.div
        className="about-card"
        initial={{ opacity: 0, y: 50 }}
        animate={{ opacity: 1, y: 0}}
        transition={{ duration: 1 }}
      >
        <h2 className="about-title">
          Welcome to <span className="about-highlight">Wanderlust Travel Agency</span>
        </h2>
        <p className="about-text">
          At Wanderlust, we believe that travel is more than just visiting new places—it’s about creating experiences, 
          embracing cultures, and making lifelong memories. Whether you&apos;re looking for a relaxing beach getaway, 
          an adventurous mountain trek, or a customized itinerary filled with hidden gems, we’ve got you covered.
        </p>
        <div className="about-features">
          <div className="about-feature">
            <h3 className="feature-title">Personalized Itineraries</h3>
            <p className="feature-text">Tailor-made trips to suit your travel style.</p>
          </div>
          <div className="about-feature">
            <h3 className="feature-title">Hassle-Free Booking</h3>
            <p className="feature-text">Seamless online booking with expert support.</p>
          </div>
          <div className="about-feature">
            <h3 className="feature-title">Best Deals & Packages</h3>
            <p className="feature-text">Affordable prices without compromising quality.</p>
          </div>
          <div className="about-feature">
            <h3 className="feature-title">24/7 Customer Support</h3>
            <p className="feature-text">Assistance whenever you need it.</p>
          </div>
        </div>
        <button className="about-button">Start Your Journey</button>
      </motion.div>
      </div>
      </div>
  );
};

export default AboutUs;
