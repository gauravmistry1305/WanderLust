// import { useState } from "react";
import "./Navbar.css";

const Navbar = () => {
//   const [isLoggedIn, setIsLoggedIn] = useState(false);

//   const handleLogout = () => {
//     setIsLoggedIn(false);
//   };

  return (
    <div>
      <nav className="navbar">
        <p className="logo">WanderLust</p>
        <ul className="nav-links">
          <li>Home</li>
          <li>Destination</li>
          <li>Packages</li>
          <li>Car-Rent</li>
          <li>About Us</li>
          <li>Contact Us</li>
          {/* {!isLoggedIn && <li className="login">Login/Register</li>}
          {isLoggedIn && (
            <li>
              <button className="logout-btn" onClick={handleLogout}>Logout</button>
            </li>
          )} */}
        </ul>
      </nav>
    </div>
  );
};

export default Navbar;
