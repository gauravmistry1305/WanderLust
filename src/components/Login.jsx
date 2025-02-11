// import React from "react";
import { Link } from "react-router-dom"; // Import Link for navigation
import { Navigate } from "react-router-dom";
import "./Login.css"; // Importing CSS for custom styles

const Login = () => {
  return (
    <div className="login-container">
      <div className="login-box">
        {/* Left Side - Image */}
        <div className="login-left">
          <img
            src="./src/img/loginimg.png"
            alt="Illustration of a woman working on a computer"
            className="login-image"
          />
        </div>

        {/* Right Side - Login Form */}
        <div className="login-right">
          <h2 className="title">Login</h2>
          <p className="subtitle">
            Doesn&apos;t have an account yet?{" "}
            <Link to={Navigate('./src/components/Register.jsx')} className="signup-link">Sign Up</Link>
          </p>

          <form className="login-form">
            <div className="form-group">
              <label>Email Address</label>
              <input type="email" placeholder="you@example.com" required />
            </div>

            <div className="form-group">
              <label>Password</label>
              <input type="password" placeholder="Enter Password" required />
              <a href="#" className="forgot-password">Forgot Password?</a>
            </div>

            <div className="form-group checkbox-group">
              <input type="checkbox" id="remember" />
              <label htmlFor="remember">Remember me</label>
            </div>

            <button type="submit" className="login-btn">LOGIN</button>

            <div className="or-text">or login with</div>

            <div className="social-login">
              <button className="social-btn google-btn">
                <i className="fab fa-google"></i> Google
              </button>
              <button className="social-btn facebook-btn">
                <i className="fab fa-facebook-f"></i> Facebook
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
