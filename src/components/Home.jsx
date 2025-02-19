import { useEffect } from "react";
import Navbar from "./Navbar";
import Footer from "./Footer";
import Aboutus from "./Aboutus";
import Contact from "./Contact";
import Destination from "./Destination";
import "./Home.css";

const Home = () => {
  useEffect(() => {
    // Intersection Observer for Scroll Animations
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate-on-scroll");
          }
        });
      },
      { threshold: 0.3 }
    );

    const elements = document.querySelectorAll(
      ".travel-box, .tourism-box, .travel-list, .travel-benefits"
    );
    elements.forEach((el) => observer.observe(el));

    return () => elements.forEach((el) => observer.unobserve(el));
  }, []);

  return (
    <div className="home-wrapper">
      <Navbar />

      {/* Hero Section */}
      <div className="home-container">
        <div className="hero-section">
          <h1>Welcome to WanderLust</h1>
        </div>
      </div>

      {/* Travel Information Section */}
      <div className="info-section">
        <div className="info-container">
          {/* Travel Section */}
          <div className="travel-box">
            <h2>What is Travel?</h2>
            <p>
              Travel refers to the movement of people from one place to another, typically for leisure, business, or other purposes. It can be
              <strong> domestic</strong> (within the same country) or <strong> international</strong> (crossing borders).
            </p>
          </div>

          {/* Tourism Section */}
          <div className="tourism-box">
            <h2>What is Tourism?</h2>
            <p>
              Tourism is a subset of travel that involves visiting places for leisure, recreation, or cultural experiences. According to the
              <strong> World Tourism Organization (UNWTO)</strong>:
              <em> “The activities of persons traveling to and staying in places outside their usual environment for not more than one consecutive year
                for leisure, business, or other purposes.” </em>
            </p>
          </div>
        </div>

        {/* Types of Travel */}
        <h2>Types of Travel</h2>
        <div className="travel-type-container">
          <ul className="travel-list">
            <li>🌍 <strong>Leisure Travel</strong> – Vacations, adventure trips, and luxury getaways.</li>
            <li>💼 <strong>Business Travel</strong> – Corporate trips, conferences, and meetings.</li>
            <li>🏛 <strong>Cultural Travel</strong> – Exploring heritage sites, traditions, and history.</li>
          </ul>
          <ul className="travel-list">
            <li>🌱 <strong>Eco-Tourism</strong> – Sustainable travel that promotes environmental conservation.</li>
            <li>⛰ <strong>Adventure Travel</strong> – Trekking, scuba diving, safaris, etc.</li>
            <li>🙏 <strong>Religious Tourism</strong> – Visiting sacred sites, temples, churches, and pilgrimages.</li>
          </ul>
        </div>

        {/* Importance of Travel */}
        <h2>Importance of Travel</h2>
        <div className="travel-benefit-container">
          <ul className="travel-benefits">
            <li>✔️ <strong>Cultural Exchange</strong> – Experience new languages, traditions, and lifestyles.</li>
            <li>✔️ <strong>Economic Growth</strong> – Supports local economies, businesses, and employment.</li>
          </ul>
          <ul className="travel-benefits">
            <li>✔️ <strong>Personal Growth</strong> – Increases knowledge, adaptability, and mental well-being.</li>
            <li>✔️ <strong>Environmental Awareness</strong> – Encourages sustainable tourism practices.</li>
          </ul>
        </div>
      </div>

      {/* Other Sections */}
      <Destination />
      <Aboutus />
      <Contact />
      <Footer />
    </div>
  );
};

export default Home;
