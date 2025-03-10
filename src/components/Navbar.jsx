import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import "./Navbar.css";

const Navbar = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  // Check if the user is logged in when the component mounts
  useEffect(() => {
    const userLoggedIn = localStorage.getItem("isLoggedIn") === "true";
    setIsLoggedIn(userLoggedIn);
  }, []);

  const handleLogout = () => {
    localStorage.removeItem("isLoggedIn"); // Remove login state
    setIsLoggedIn(false);
  };

  return (
    <nav className="navbar">
      <p className="logo">WanderLust</p>
      <ul className="nav-links">
        <li><Link to="/">Home</Link></li>
        <li><Link to="/md">Destination</Link></li>
        <li><Link to="/packages">Packages</Link></li>
        <li><Link to="/carrent">CarRent</Link></li>
        <li><Link to="/about">About Us</Link></li>
        <li><Link to="/contact">Contact Us</Link></li>

        {!isLoggedIn ? (
          <li className="login"><Link to="/login"> <h3>Login/Register</h3></Link></li>
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
