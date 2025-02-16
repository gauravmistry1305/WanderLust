import { motion } from "framer-motion";
import "./AboutUs.css";

const AboutUs = () => {
  return (
    <div className="about">
      {/* Page Title */}
      <motion.h2 
        className="about-heading"
        initial={{ opacity: 0, y: -50 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 1 }}
      >
        Discover Who We Are 🌍✨
      </motion.h2>

      <div className="about-container">
        {/* Animated Card */}
        <motion.div
          className="about-card"
          initial={{ opacity: 0, y: 50 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 1 }}
        >
          <h2 className="about-title">
            Welcome to <span className="about-highlight">Wanderlust Travel Agency</span>
          </h2>
          <p className="about-text">
            At Wanderlust, we turn your travel dreams into reality. Whether you&apos;re looking for a **romantic getaway, a thrilling adventure, or a relaxing beach escape**, we craft unforgettable experiences tailored to your needs. Our expert team ensures every trip is seamless, enjoyable, and stress-free.
          </p>
          
          {/* Mission & Vision Section */}
          <div className="about-mission">
            <motion.div 
              className="mission-card"
              whileHover={{ scale: 1.05 }}
            >
              <h3>🌟 Our Mission</h3>
              <p>To create **unforgettable travel experiences** that inspire and bring people closer to different cultures and destinations.</p>
            </motion.div>

            <motion.div 
              className="vision-card"
              whileHover={{ scale: 1.05 }}
            >
              <h3>🚀 Our Vision</h3>
              <p>To become the **leading travel agency worldwide**, known for innovation, affordability, and top-tier service.</p>
            </motion.div>
          </div>

          {/* Key Features */}
          <div className="about-features">
            <motion.div className="about-feature" whileHover={{ scale: 1.05 }}>
              <h3 className="feature-title">📍 Personalized Itineraries</h3>
              <p className="feature-text">Your journey, your way—custom travel plans crafted to match your style.</p>
            </motion.div>
            <motion.div className="about-feature" whileHover={{ scale: 1.05 }}>
              <h3 className="feature-title">🛫 Hassle-Free Booking</h3>
              <p className="feature-text">Seamless reservations with top travel deals and expert guidance.</p>
            </motion.div>
            <motion.div className="about-feature" whileHover={{ scale: 1.05 }}>
              <h3 className="feature-title">💰 Best Deals & Discounts</h3>
              <p className="feature-text">We bring you the best prices without compromising on quality.</p>
            </motion.div>
            <motion.div className="about-feature" whileHover={{ scale: 1.05 }}>
              <h3 className="feature-title">☎ 24/7 Customer Support</h3>
              <p className="feature-text">We’re here to assist you, anytime, anywhere.</p>
            </motion.div>
          </div>

          {/* CTA Button */}
          <motion.button 
            className="about-button"
            whileHover={{ scale: 1.1 }}
            whileTap={{ scale: 0.95 }}
          >
            Start Your Journey
          </motion.button>
        </motion.div>
      </div>
    </div>
  );
};

export default AboutUs;
