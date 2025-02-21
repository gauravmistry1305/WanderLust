import { useState } from "react";
import './Contact.css';
const Contact = () => {
  // State for form fields
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  const [submitted, setSubmitted] = useState(false);

  // Handle input changes
  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  // Handle form submission
  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Form Submitted:", formData);
    setSubmitted(true);
    setFormData({ name: "", email: "", message: "" }); // Reset form after submission
  };

  return (
    <div className="contact">
      <h2>Contact Us</h2>
    <div className="container">
      {/* Left Side - Image */}
      <div className="image-container">
        <img
          src="https://storage.googleapis.com/a1aa/image/Ue0NIRK5-b49fKiaY4bcKVRl9m290lJtrijGbMH6kO4.jpg"
          alt="Illustration of a woman working on a laptop"
        />
      </div>

      {/* Right Side - Form */}
      <div className="form-container">
        
        {submitted ? (
          <p className="success-message">Thank you! Your message has been sent.</p>
        ) : (
          <form onSubmit={handleSubmit}>
            <input
              type="text"
              name="name"
              placeholder="Name"
              value={formData.name}
              onChange={handleChange}
              required
            />
            <input
              type="email"
              name="email"
              placeholder="Email"
              value={formData.email}
              onChange={handleChange}
              required
            />
            <textarea
              name="message"
              placeholder="Message"
              value={formData.message}
              onChange={handleChange}
              required
            />
            <button type="submit">SUBMIT</button>
          </form>
        )}
        </div>
        
      </div>
      </div>
  );
};

export default Contact;
