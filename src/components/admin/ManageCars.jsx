import { useState } from "react";
import "./ManageCars.css";

const ManageCars = () => {
  const [cars, setCars] = useState([
    { id: 1, name: "Innova Crysta", price: "₹2500/day", seats: "7 Seater" },
    { id: 2, name: "Swift Dzire", price: "₹1500/day", seats: "5 Seater" },
  ]);

  const [newCar, setNewCar] = useState({ name: "", price: "", seats: "" });

  const handleAddCar = (e) => {
    e.preventDefault();
    const newId = cars.length + 1;
    setCars([...cars, { id: newId, ...newCar }]);
    setNewCar({ name: "", price: "", seats: "" });
  };

  const handleDelete = (id) => {
    const filteredCars = cars.filter((car) => car.id !== id);
    setCars(filteredCars);
  };

  return (
    <div className="cars-container">
      <h2>Manage Cars</h2>
      <form className="car-form" onSubmit={handleAddCar}>
        <input
          type="text"
          placeholder="Car Name"
          value={newCar.name}
          onChange={(e) => setNewCar({ ...newCar, name: e.target.value })}
          required
        />
        <input
          type="text"
          placeholder="Price per day"
          value={newCar.price}
          onChange={(e) => setNewCar({ ...newCar, price: e.target.value })}
          required
        />
        <input
          type="text"
          placeholder="Seats"
          value={newCar.seats}
          onChange={(e) => setNewCar({ ...newCar, seats: e.target.value })}
          required
        />
        <button type="submit">Add Car</button>
      </form>

      <div className="car-list">
        {cars.map((car) => (
          <div className="car-card" key={car.id}>
            <h3>{car.name}</h3>
            <p>Price: {car.price}</p>
            <p>Seats: {car.seats}</p>
            <button onClick={() => handleDelete(car.id)}>Delete</button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ManageCars;
