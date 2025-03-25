import "./Cars.css";
import CarNav from "./CarNav";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

const carData = [
  { name: "Maruti Suzuki Swift", image: "./src/img/swift.webp", specs: "Petrol | 22 kmpl | 5-Seater | Automatic/Manual", price: "₹500/day" },
  { name: "Hyundai i20", image: "./src/img/i20.jpg", specs: "Petrol | 20 kmpl | 5-Seater | Sunroof Option", price: "₹620/day" },
  { name: "Tata Altroz", image: "./src/img/altroz.webp", specs: "Diesel/Petrol | 22-25 kmpl | 5-Star Safety", price: "₹580/day" },
  { name: "Volkswagen Polo", image: "./src/img/polo.jpg", specs: "Turbo Petrol | 18 kmpl | 5-Seater | Performance Hatch", price: "₹700/day" },
  { name: "Renault Kwid", image: "./src/img/kwid.webp", specs: "Petrol | 21 kmpl | 5-Seater | Budget-Friendly", price: "₹550/day" },
  { name: "Honda City", image: "./src/img/hondacity.webp", specs: "Petrol | 18 kmpl | 5-Seater | Premium Sedan", price: "₹700/day" },
  { name: "Hyundai Verna", image: "./src/img/verna.webp", specs: "Turbo Petrol | 20 kmpl | Stylish & Feature-Rich", price: "₹800/day" },
  { name: "Maruti Suzuki Ciaz", image: "./src/img/ciaz.png", specs: "Mild-Hybrid | 21 kmpl | Spacious Sedan", price: "₹650/day" },
  { name: "Skoda Slavia", image: "./src/img/slavia.jpg", specs: "Turbo Petrol | 19 kmpl | German Engineering", price: "₹700/day" },
  { name: "Toyota Camry Hybrid", image: "./src/img/camry.jpg", specs: "Hybrid | 22 kmpl | Luxury & Comfort", price: "₹1000/day" },
  { name: "Mahindra Thar", image: "./src/img/thar.webp", specs: "Diesel | 15 kmpl | 4x4 | Off-Roader", price: "₹1400/day" },
  { name: "Tata Harrier", image: "./src/img/harrier.jpg", specs: "Diesel | 16 kmpl | SUV | 5-Star Safety", price: "₹1650/day" },
  { name: "Hyundai Creta", image: "./src/img/creta.webp", specs: "Petrol/Diesel | 19 kmpl | Best-Selling SUV", price: "₹1500/day" },
  { name: "Kia Seltos", image: "./src/img/seltos.jpg", specs: "Turbo Petrol | 18 kmpl | Sporty SUV", price: "₹1400/day" },
  { name: "MG Hector", image: "./src/img/hector.webp", specs: "Hybrid | 15 kmpl | AI-Enabled SUV", price: "₹1500/day" },
  { name: "Toyota Fortuner", image: "./src/img/fortuner.webp", specs: "Diesel | 12 kmpl | Premium 7-Seater SUV", price: "₹2000/day" },
  { name: "Mahindra XUV700", image: "./src/img/xuv700.webp", specs: "Diesel/Petrol | 14 kmpl | ADAS Features", price: "₹2000/day" },
  { name: "Tata Nexon EV", image: "./src/img/nexon.jpg", specs: "Electric | 325 km Range | Fast Charging", price: "₹1100/day" },
  { name: "MG ZS EV", image: "./src/img/zs.webp", specs: "Electric | 419 km Range | SUV Design", price: "₹800/day" },
  { name: "Hyundai Kona EV", image: "./src/img/kona.webp", specs: "Electric | 452 km Range | Premium EV", price: "₹700/day" }
];

const Cars = () => {
  const [selectedCar, setSelectedCar] = useState(null);
  const [fromDate, setFromDate] = useState("");
  const [toDate, setToDate] = useState("");
  const [participants, setParticipants] = useState(1); // State for number of participants
  const isLoggedIn = localStorage.getItem("isLoggedIn");
  const navigate = useNavigate();

  // Handle booking
  const handleBooking = (car) => {
    if (!isLoggedIn) {
      alert("You must be logged in to book a car!");
      navigate("/login");
      return;
    }
    setSelectedCar(car);
  };

  // Calculate total price
  const calculateTotalPrice = () => {
    if (!fromDate || !toDate) return 0;

    const start = new Date(fromDate);
    const end = new Date(toDate);
    const days = (end - start) / (1000 * 60 * 60 * 24); // Calculate difference in days
    const pricePerDay = parseInt(selectedCar.price.replace(/[^\d]/g, "")); // Extract numeric price

    return days > 0 ? pricePerDay * days * participants : 0; // Calculate total price
  };

  return (
    <>
      <CarNav />
      <div className="cars-container">
        {carData.map((car, index) => (
          <div key={index} className="car-card">
            <img src={car.image} alt={car.name} />
            <h3>{car.name}</h3>
            <p className="specs">{car.specs}</p>
            <p className="price">{car.price}</p>
            <button className="rent-btn" onClick={() => handleBooking(car)}>Details</button>
          </div>
        ))}
      </div>

      {/* Modal for car details */}
      {selectedCar && (
        <div className="modal">
          <div className="modal-content">
            <span className="close-btn" onClick={() => setSelectedCar(null)}>&times;</span>
            <div className="modal-left">
              <img src={selectedCar.image} alt={selectedCar.name} />
              <h3>{selectedCar.name}</h3>
              <p className="specs">{selectedCar.specs}</p>
              <p className="price">{selectedCar.price}</p>
            </div>
            <div className="modal-right">
              <h3>Book This Car</h3>
              <form>
                <input type="text" placeholder="Full Name" required />
                <input type="email" placeholder="Email" required />
                <input type="tel" placeholder="Phone Number" required />

                {/* Start Date */}
                <input
                  type="date"
                  required
                  value={fromDate}
                  onChange={(e) => setFromDate(e.target.value)}
                  min={new Date().toISOString().split("T")[0]}
                />

                {/* End Date */}
                <input
                  type="date"
                  required
                  value={toDate}
                  onChange={(e) => setToDate(e.target.value)}
                  min={fromDate ? new Date(new Date(fromDate).getTime() + 86400000).toISOString().split("T")[0] : ""}
                />

                {/* Number of Participants */}
                {/* <input
                  type="number"
                  min="1"
                  value={participants}
                  onChange={(e) => setParticipants(parseInt(e.target.value) || 1)}
                  placeholder="Number of Travelers"
                  required
                /> */}

                {/* Display Total Price */}
                <p><strong>Total Price:</strong> ₹{calculateTotalPrice().toLocaleString()}</p>

                <button type="submit" className="rent-btn">Confirm Booking</button>
              </form>
            </div>
          </div>
        </div>
      )}
    </>
  );
};

export default Cars;