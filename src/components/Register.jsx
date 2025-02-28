import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './Register.css';

const Register = () => {
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();
        if (password !== confirmPassword) {
            setError('Passwords do not match!');
        } else {
            setError('');
            alert('Registration Successful');
            navigate('/login');
        }
    };

    return (
        <div className="register-container">
            <div className="register-box">
                
                {/* Left Section: Text + Image */}
                <div className="register-left">
                    <p className="register-message">Register yourself </p>
                    <div className="register-image">
                        <img src="/src/img/register.jpg" alt="Register" />
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
                        <input type="text" name="contactnumber" id="contactnumber" required />

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

                        {error && <p className="error-text">{error}</p>}

                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Register;
