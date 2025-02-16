import Navbar from "./Navbar";
import Footer from "./Footer";
import Aboutus from "./Aboutus";
import Contact from "./Contact";
import Destination from "./Destination"; 

const Home = () => {
  return (
    <div>
      <Navbar />
      <div className="home-container">
        <h1></h1>
      </div>
      <Destination /> {/* Added after About Us */}
      <Aboutus />
      <Contact />
      <Footer />
    </div>
  );
};

export default Home;
