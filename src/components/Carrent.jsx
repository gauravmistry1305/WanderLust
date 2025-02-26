import "./Carrent.css";
import CarNav from './CarNav';
import Footer from './Footer';

const Carrent = () => {
  return (
    <>
    <div className="bg-gray-100">     
         <CarNav/>
      <main>
        <section className="hero">
          <img
            src="./src/img/carimg2.jpg"
            alt="Red car on a scenic road"
            className="hero-image"
          />
          <div className="hero-content">
            <h1>FIND THE IDEAL CAR FOR YOU.</h1>
            <p>We have more cars for you to choose.</p>
          </div>
        </section>
        <section className="info-section">
          <h2>Find the Best Car For You</h2>
          <p>
            It is above all the uncompromising, performance-oriented aesthetic
            that unmistakably reveals its ambitions. Not elegant but
            extravagant. Not conventional but individual.
          </p>
        </section>
      </main>
      </div>
      <Footer />
    </>
  );
};

export default Carrent;
