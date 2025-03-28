import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Register from './components/Register';
import Login from './components/Login';
import Home from './components/Home';
import Carrent from "./components/Carrent";
import Aboutus from "./components/Aboutus";
import Contact from "./components/Contact";
import MD from "./components/MD";
import Cars from "./components/Cars";
import Packages from "./components/Packages";
import AdminLogin from "./components/admin/AdminLogin";
import AdminDashboard from "./components/admin/AdminDashboard";
import ManageTrips from "./components/admin/ManageTrips";
import ManageCars from "./components/admin/ManageCars";
// import CarsManage from "./components/admin/CarsManage";
// import Bookings from "./components/admin/Bookings";
// import Settings from "./components/admin/Settings";
// import Messages from "./components/admin/Messages";
// import UsersManage from "./components/admin/UsersManage";
import './App.css';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/md" element={<MD />} />
        <Route path="/packages" element={<Packages />} />
        <Route path="/carrent" element={<Carrent />} />
        <Route path="/cars" element={<Cars />} />
        <Route path="/about" element={<Aboutus />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/adminlogin" element={<AdminLogin />} />
        <Route path="/admindashboard" element={<AdminDashboard />} />
        <Route path="/manage-trips" element={<ManageTrips />} />
        <Route path="/manage-cars" element={<ManageCars />} />
        {/* <Route path="/admin" element={<Admin />} /> */}
        {/* <Route path="/tripManage" element={<TripManage />} />
        <Route path="/carsManage" element={<CarsManage />} />
        <Route path="/bookings" element={<Bookings />} />
        <Route path="/settings" element={<Settings />} />
        <Route path="/messages" element={<Messages />} />
        <Route path="/usersManage" element={<UsersManage />} /> */}
      </Routes>
    </Router>
  );
}

export default App;
