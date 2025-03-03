import { useState } from "react";
import { useNavigate } from "react-router-dom";
import registerImage from "../img/register.jpg"; // Adjust path if needed
import "./Register.css";

const Register = () => {
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [error, setError] = useState("");
    const navigate = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();
        if (password !== confirmPassword) {
            setError("Passwords do not match!");
        } else {
            setError("");
            alert("Registration Successful");
            navigate("/login");
        }
    };

    return (
        <div className="register-container">
            <div className="register-box">
                {/* Left Section: Text + Image */}
                <div className="register-left">
                    <p className="register-message">Register Yourself</p>
                    <div className="register-image">
                        <img src={registerImage} alt="Register" />
                    </div>
                </div>

                {/* Right Section: Registration Form */}
                <div className="register-form">
                    <form onSubmit={handleSubmit}>
                        <h1>User Sign-up</h1>

                        <label>First Name:</label>
                        <input type="text" name="firstname" id="firstname" required />

                        <label>Last Name:</label>
                        <input type="text" name="lastname" id="lastname" required />

                        <label>Contact Number:</label>
                        <input
                            type="tel"
                            name="contactnumber"
                            id="contactnumber"
                            pattern="[0-9]{10}"
                            title="Enter a 10-digit phone number"
                            required
                        />

                        <label>Email:</label>
                        <input type="email" name="email" id="email" required />

                        <label>Password:</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            required
                        />

                        <label>Confirm Password:</label>
                        <input
                            type="password"
                            name="password2"
                            id="password2"
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                            required
                        />

                        {/* Improved Error Handling */}
                        <p className="error-text">{error ? error : <span>&nbsp;</span>}</p>

                        <button type="submit" className="submit-btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Register;
