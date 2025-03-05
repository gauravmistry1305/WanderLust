import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import "./CarNav.css";

const Navbar = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  // Check if user is logged in when component mounts
  useEffect(() => {
    const userLoggedIn = localStorage.getItem("isLoggedIn") === "true";
    console.log("User Logged In:", userLoggedIn); // Debugging log
    setIsLoggedIn(userLoggedIn);
  }, []);

  // Logout function
  const handleLogout = () => {
    localStorage.removeItem("isLoggedIn"); // Remove login state
    setIsLoggedIn(false);
    window.location.reload(); // Force UI update
  };

  return (
    <nav className="navbar">
      <p className="logo">WanderLust</p>
      <ul className="nav-links">
        <li><Link to="/carrent">Home</Link></li>
        <li><Link to="/">Trip</Link></li>
        <li><Link to="/cars">Cars</Link></li>
        <li><Link to="/about">About Us</Link></li>
        <li><Link to="/contact">Contact Us</Link></li>

        {!isLoggedIn ? (
          <li className="login">
            <Link to="/login"><h3>Login/Register</h3></Link>
          </li>
        ) : (
          <li>
            <button className="logout-btn" onClick={handleLogout}>Logout</button>
          </li>
        )}
      </ul>
    </nav>
  );
};

export default Navbar;
