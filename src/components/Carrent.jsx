import "./Carrent.css";
import CarNav from './CarNav';
import Footer from './Footer';

const Carrent = () => {
  return (
    <>
      <CarNav />
      <div className="carhero">
        <div className="carhome">
        <div className="cartitle">
          <h1 className="car">Welcome to WanderLust</h1>
          <p className="car">Find and Book your dream ride with your loved one :)</p>
          </div>
          </div>
      </div>
      <Footer />
    </>
  );
};

export default Carrent;
