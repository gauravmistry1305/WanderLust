import "./Admin.css";
import { useState } from "react";
import TripManage from "./TripManage";
import CarsManage from "./CarsManage";
// import ManageItineraries from "./ManageItineraries";
import UsersManage from "./UsersManage";
import Bookings from "./Bookings";
import Messages from "./Messages";
import Settings from "./Settings";

const Admin = () => {
  const [activePanel, setActivePanel] = useState("Dashboard");

  const renderPanel = () => {
    switch (activePanel) {
      case "Manage Trips":
        return <TripManage />;
      case "Manage Cars":
        return <CarsManage />;
      // case "Manage Itineraries":
      //   return <ManageItineraries />;
      case "Manage Users":
        return <UsersManage />;
      case "Bookings":
        return <Bookings />;
      case "Messages":
        return <Messages />;
      case "Settings":
        return <Settings />;
      default:
        return <h2>Welcome, Admin! Please select a panel to manage.</h2>;
    }
  };

  return (
    <div className="admin-container">
      <div className="sidebar">
        <h2>Admin Panel</h2>
        <ul>
          {[
            "Manage Trips",
            "Manage Cars",
            "Manage Itineraries",
            "Manage Users",
            "Bookings",
            "Messages",
            "Settings",
          ].map((item) => (
            <li key={item} onClick={() => setActivePanel(item)}>
              {item}
            </li>
          ))}
        </ul>
      </div>
      <div className="main-content">{renderPanel()}</div>
    </div>
  );
};

export default Admin;
