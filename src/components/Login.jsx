import { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import "./Login.css";

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  // const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();

    // Dummy login validation (Replace with backend API)
    // if (email === "test@example.com" && password === "password123") {
      localStorage.setItem("isLoggedIn", "true"); // Save login state
      alert("Login Successful");
      navigate("/"); // Redirect to home after login
    // } else {
    //   setError("Invalid email or password.");
    // }
  };

  return (
    <div className="login-wrapper">
      <div className="login-container">
        {/* Left Side - Image Section */}
        <div className="login-image">
          <p className="login-text">Hey, Welcome back Buddy..</p>
          <img src="/src/img/logo.jpg" alt="Login" />
        </div>

        {/* Right Side - Login Form */}
        <div className="login-form">
          <form onSubmit={handleSubmit}>
            <h1>User Login</h1>

            <label>Email:</label>
            <input
              type="email"
              name="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />

            <label>Password:</label>
            <input
              type="password"
              name="password"
              id="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />

            {/* {error && <p className="error-text">{error}</p>} */}

            <button type="submit" className="login-btn">
              Login
            </button>

            <div className="or-text">or login with</div>

            {/* Social Login Buttons */}
            <div className="social-login">
              <button className="social-btn google-btn">
                <i className="fab fa-google"></i> Google
              </button>
              <button className="social-btn facebook-btn">
                <i className="fab fa-facebook-f"></i> Facebook
              </button>
            </div>

            <p className="register-link">
              Don&apos;t have an account? <Link to="/register">Register</Link>
            </p>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
