import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Register from './components/Register';
import Login from './components/Login';
import Home from './components/Home';
import Carrent from "./components/Carrent";
import Aboutus from "./components/Aboutus";
import Contact from "./components/Contact";
import MD from "./components/MD";
import Packages from "./components/Packages";
import './App.css';

const App = () => {
  return (
    <Router>
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='/login' element={<Login />} />
        <Route path='/register' element={<Register />} />
        <Route path='/md' element={<MD />} />
        <Route path='/packages' element={<Packages />} />
        <Route path='/carrent' element={<Carrent />} />
        <Route path='/about' element={<Aboutus />} />
        <Route path='/contact' element={<Contact />} />
      </Routes>
    </Router>
  );
}

export default App;
