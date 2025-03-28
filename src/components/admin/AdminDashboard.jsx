import "./AdminDashboard.css";
import { Link } from "react-router-dom";

const AdminDashboard = () => {
  const handleLogout = () => {
    alert("Logged out successfully!");
    window.location.href = "/admin-login";
  };

  return (
    <div>
      <nav className="admin-navbar">
        <h1>🌍 WanderLust Admin</h1>
        <button onClick={handleLogout}>Logout</button>
      </nav>

      <div className="dashboard-container">
        <div className="dashboard-card">
          <h3>Manage Trips</h3>
          <Link to="/manage-trips">Go to Trips</Link>
        </div>
        <div className="dashboard-card">
          <h3>Manage Cars</h3>
          <Link to="/manage-cars">Go to Cars</Link>
        </div>
        <div className="dashboard-card">
          <h3>Manage Bookings</h3>
          <Link to="/manage-bookings">View Bookings</Link>
        </div>
        <div className="dashboard-card">
          <h3>Manage Users</h3>
          <Link to="/manage-users">View Users</Link>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
