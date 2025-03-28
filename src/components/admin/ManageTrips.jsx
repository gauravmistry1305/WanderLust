import { useState } from "react";
import "./ManageTrips.css";

const ManageTrips = () => {
  const [trips, setTrips] = useState([
    { id: 1, name: "Manali Tour", price: "₹8000", duration: "5 Days" },
    { id: 2, name: "Goa Trip", price: "₹12000", duration: "4 Days" },
  ]);

  const [newTrip, setNewTrip] = useState({ name: "", price: "", duration: "" });

  const handleAddTrip = (e) => {
    e.preventDefault();
    const newId = trips.length + 1;
    setTrips([...trips, { id: newId, ...newTrip }]);
    setNewTrip({ name: "", price: "", duration: "" });
  };

  const handleDelete = (id) => {
    const filteredTrips = trips.filter((trip) => trip.id !== id);
    setTrips(filteredTrips);
  };

  return (
    <div className="trips-container">
      <h2>Manage Trips</h2>
      <form className="trip-form" onSubmit={handleAddTrip}>
        <input
          type="text"
          placeholder="Trip Name"
          value={newTrip.name}
          onChange={(e) => setNewTrip({ ...newTrip, name: e.target.value })}
          required
        />
        <input
          type="text"
          placeholder="Price"
          value={newTrip.price}
          onChange={(e) => setNewTrip({ ...newTrip, price: e.target.value })}
          required
        />
        <input
          type="text"
          placeholder="Duration"
          value={newTrip.duration}
          onChange={(e) => setNewTrip({ ...newTrip, duration: e.target.value })}
          required
        />
        <button type="submit">Add Trip</button>
      </form>

      <div className="trip-list">
        {trips.map((trip) => (
          <div className="trip-card" key={trip.id}>
            <h3>{trip.name}</h3>
            <p>Price: {trip.price}</p>
            <p>Duration: {trip.duration}</p>
            <button onClick={() => handleDelete(trip.id)}>Delete</button>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ManageTrips;
