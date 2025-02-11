import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './Login.css';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();
        alert('Login Successful');
        navigate('/home');
        // Redirect logic can be added here
    };

    return (
        <div className="login-form">
            <form onSubmit={handleSubmit}>
                <h1>Login</h1>

                <label>Email:</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required />
                <br />

                <label>Password:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />
                <br />

                <button type="submit">Login</button>
            </form>
        </div>
    );
};

export default Login;
