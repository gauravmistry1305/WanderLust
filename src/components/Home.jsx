import Navbar from "./Navbar";
import Footer from "./Footer";
import Aboutus from "./Aboutus";
import Contact from "./Contact";
import Destination from "./Destination"; 

const Home = () => {
  return (
    <div>
      <Navbar />
      <Destination /> {/* Added after About Us */}
      <Aboutus />
      <Contact />
      <Footer />
    </div>
  );
};

export default Home;
