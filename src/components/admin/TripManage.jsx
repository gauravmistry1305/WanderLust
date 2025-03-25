import { useState } from "react";
import "./TripManage.css";

const initialTrips = [
  { id: 1, name: "Goa Beach Adventure", duration: "5 Days", price: "$300" },
  { id: 2, name: "Jaipur Heritage Tour", duration: "3 Days", price: "$200" },
  { id: 3, name: "Manali Snow Experience", duration: "7 Days", price: "$500" }
];

const ManageTrip = () => {
  const [trips, setTrips] = useState(initialTrips);
  const [newTrip, setNewTrip] = useState({ name: "", duration: "", price: "" });
  const [isEditing, setIsEditing] = useState(false);
  const [editId, setEditId] = useState(null);

  const handleAddTrip = () => {
    if (newTrip.name && newTrip.duration && newTrip.price) {
      setTrips([...trips, { ...newTrip, id: trips.length + 1 }]);
      setNewTrip({ name: "", duration: "", price: "" });
    }
  };

  const handleDeleteTrip = (id) => {
    setTrips(trips.filter(trip => trip.id !== id));
  };

  const handleEditTrip = (trip) => {
    setIsEditing(true);
    setEditId(trip.id);
    setNewTrip({ name: trip.name, duration: trip.duration, price: trip.price });
  };

  const handleUpdateTrip = () => {
    if (newTrip.name && newTrip.duration && newTrip.price) {
      setTrips(
        trips.map(trip =>
          trip.id === editId ? { ...trip, ...newTrip } : trip
        )
      );
      setNewTrip({ name: "", duration: "", price: "" });
      setIsEditing(false);
      setEditId(null);
    }
  };

  return (
    <div className="manage-trip-container">
      <h2>Manage Trips</h2>
      <div className="add-trip-form">
        <input
          type="text"
          placeholder="Trip Name"
          value={newTrip.name}
          onChange={(e) => setNewTrip({ ...newTrip, name: e.target.value })}
        />
        <input
          type="text"
          placeholder="Duration"
          value={newTrip.duration}
          onChange={(e) => setNewTrip({ ...newTrip, duration: e.target.value })}
        />
        <input
          type="text"
          placeholder="Price"
          value={newTrip.price}
          onChange={(e) => setNewTrip({ ...newTrip, price: e.target.value })}
        />
        {isEditing ? (
          <button onClick={handleUpdateTrip}>Update Trip</button>
        ) : (
          <button onClick={handleAddTrip}>Add Trip</button>
        )}
      </div>
      <ul className="trip-list">
        {trips.map(trip => (
          <li key={trip.id} className="trip-item">
            <div>
              <strong>{trip.name}</strong> - {trip.duration} - {trip.price}
            </div>
            <button onClick={() => handleEditTrip(trip)}>Edit</button>
            <button onClick={() => handleDeleteTrip(trip.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ManageTrip;
