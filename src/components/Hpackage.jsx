import { useState } from "react";
import { useNavigate } from "react-router-dom"; // Import navigation hook
import { Link } from "react-router-dom";
import "./Hpackage.css";

const packages = [
  { id: 1, destination: "Goa", price: 15000, duration: "5 Days / 4 Nights", image: "https://cdn.pixabay.com/photo/2017/01/20/00/30/beach-1993704_1280.jpg" },
  
  { id: 2, destination: "Jaipur", price: 18000, duration: "4 Days / 3 Nights", image: "/src/img/jaipur.jpg" },
  { id: 3, destination: "Manali", price: 30000, duration: "6 Days / 5 Nights", image: "/src/img/manali.jpg" },
  { id: 4, destination: "Varanasi", price: 15000, duration: "3 Days / 2 Nights", image: "/src/img/varansi1.jpeg" },
];

const Packages = () => {
  const [selectedPackage, setSelectedPackage] = useState(null);
  const [showForm, setShowForm] = useState(false);
  const [participants, setParticipants] = useState(1);
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "",
    travelDate: "",
  });

  const navigate = useNavigate(); // Hook to navigate pages

  // Get today's date in YYYY-MM-DD format
  const getTodayDate = () => {
    return new Date().toISOString().split("T")[0];
  };

  // Function to check if user is logged in
  const isUserLoggedIn = () => {
    return localStorage.getItem("isLoggedIn") === "true";
  };

  const openForm = (pkg) => {
    if (!isUserLoggedIn()) {
      alert("You are not logged in! Please log in to proceed with booking.");
      navigate("/login"); // Redirect to login page
      return;
    }
    setSelectedPackage(pkg);
    setShowForm(true);
    setParticipants(1);
    setFormData({ name: "", email: "", phone: "", travelDate: "" });
  };

  const closeForm = () => {
    setShowForm(false);
    setSelectedPackage(null);
  };

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault(); // Prevent form from reloading the page
    alert(`Thank you, ${formData.name}! Your booking for ${selectedPackage?.destination} is confirmed. 🎉`);
    closeForm(); // Close the modal after confirmation
  };

  return (
    <div>
      <div className="packages-container">
        <h1>Best Tour Packages from Ahmedabad</h1>
        <div className="packages-grid">
          {packages.map((pkg) => (
            <div className="package-card" key={pkg.id}>
              <img src={pkg.image} alt={pkg.destination} className="package-image" />
              <h2>{pkg.destination}</h2>
              <p><strong>Price:</strong> ₹{pkg.price.toLocaleString()}</p>
              <p><strong>Duration:</strong> {pkg.duration}</p>
              <button className="book-btn" onClick={() => openForm(pkg)}>Book Now</button>
            </div>
          ))}
        </div>
      </div>

      {showForm && (
        <div className="modal">
          <div className="modal-content">
            <span className="p-close-btn" onClick={closeForm}>&times;</span>
            <h2>Book Your Trip to {selectedPackage?.destination}</h2>
            <p><strong>Base Price:</strong> ₹{selectedPackage?.price.toLocaleString()}</p>
            <p><strong>Duration:</strong> {selectedPackage?.duration}</p>

            <form className="booking-form" onSubmit={handleSubmit}>
              <label>Name:</label>
              <input type="text" name="name" value={formData.name} onChange={handleChange} placeholder="Enter your name" required />

              <label>Email:</label>
              <input type="email" name="email" value={formData.email} onChange={handleChange} placeholder="Enter your email" required />

              <label>Phone:</label>
              <input type="tel" name="phone" value={formData.phone} onChange={handleChange} placeholder="Enter your phone number" required />

              <label>Number of Travelers:</label>
              <input type="number" min="1" value={participants} onChange={(e) => setParticipants(e.target.value)} required />

              <label>Travel Date:</label>
              <input type="date" name="travelDate" value={formData.travelDate} onChange={handleChange} min={getTodayDate()} required />

              <p><strong>Total Price:</strong> ₹{(selectedPackage?.price * participants).toLocaleString()}</p>

              <button type="submit" className="submit-btn">Confirm Booking</button>
            </form>
          </div>
        </div>
            )}
            <div className="more-destination-btn">
        <button><Link to="/packages"> More Packages </Link></button>
      </div>
    </div>
  );
};

export default Packages;
