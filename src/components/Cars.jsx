import "./Cars.css";
import CarNav from "./CarNav";

const carData = [
  // Hatchbacks
  { name: "Maruti Suzuki Swift", image: "./src/img/swift.webp", specs: "Petrol | 22 kmpl | 5-Seater | Automatic/Manual", price: "₹300/hr" },
  { name: "Hyundai i20", image: "./src/img/i20.jpg", specs: "Petrol | 20 kmpl | 5-Seater | Sunroof Option", price: "₹320/hr" },
  { name: "Tata Altroz", image: "./src/img/altroz.webp", specs: "Diesel/Petrol | 22-25 kmpl | 5-Star Safety", price: "₹280/hr" },
  { name: "Volkswagen Polo", image: "./src/img/polo.jpg", specs: "Turbo Petrol | 18 kmpl | 5-Seater | Performance Hatch", price: "₹350/hr" },
  { name: "Renault Kwid", image: "./src/img/kwid.webp", specs: "Petrol | 21 kmpl | 5-Seater | Budget-Friendly", price: "₹250/hr" },

  // Sedans
  { name: "Honda City", image: "./src/img/hondacity.webp", specs: "Petrol | 18 kmpl | 5-Seater | Premium Sedan", price: "₹500/hr" },
  { name: "Hyundai Verna", image: "./src/img/verna.webp", specs: "Turbo Petrol | 20 kmpl | Stylish & Feature-Rich", price: "₹520/hr" },
  { name: "Maruti Suzuki Ciaz", image: "./src/img/ciaz.png", specs: "Mild-Hybrid | 21 kmpl | Spacious Sedan", price: "₹480/hr" },
  { name: "Skoda Slavia", image: "./src/img/slavia.jpg", specs: "Turbo Petrol | 19 kmpl | German Engineering", price: "₹550/hr" },
  { name: "Toyota Camry Hybrid", image: "./src/img/camry.jpg", specs: "Hybrid | 22 kmpl | Luxury & Comfort", price: "₹750/hr" },

  // SUVs
  { name: "Mahindra Thar", image: "./src/img/thar.webp", specs: "Diesel | 15 kmpl | 4x4 | Off-Roader", price: "₹800/hr" },
  { name: "Tata Harrier", image: "./src/img/harrier.jpg", specs: "Diesel | 16 kmpl | SUV | 5-Star Safety", price: "₹750/hr" },
  { name: "Hyundai Creta", image: "./src/img/creta.webp", specs: "Petrol/Diesel | 19 kmpl | Best-Selling SUV", price: "₹700/hr" },
  { name: "Kia Seltos", image: "./src/img/seltos.jpg", specs: "Turbo Petrol | 18 kmpl | Sporty SUV", price: "₹720/hr" },
  { name: "MG Hector", image: "./src/img/hector.webp", specs: "Hybrid | 15 kmpl | AI-Enabled SUV", price: "₹780/hr" },
  { name: "Toyota Fortuner", image: "./src/img/fortuner.webp", specs: "Diesel | 12 kmpl | Premium 7-Seater SUV", price: "₹1,200/hr" },
  { name: "Mahindra XUV700", image: "./src/img/xuv700.webp", specs: "Diesel/Petrol | 14 kmpl | ADAS Features", price: "₹950/hr" },
//   { name: "Skoda Kushaq", image: "./src/img/kushaq.jpg", specs: "Turbo Petrol | 18 kmpl | German Build", price: "₹680/hr" },

  // Electric Vehicles (EVs)
  { name: "Tata Nexon EV", image: "./src/img/nexon.jpg", specs: "Electric | 325 km Range | Fast Charging", price: "₹550/hr" },
  { name: "MG ZS EV", image: "./src/img/zs.webp", specs: "Electric | 419 km Range | SUV Design", price: "₹600/hr" },
  { name: "Hyundai Kona EV", image: "./src/img/kona.webp", specs: "Electric | 452 km Range | Premium EV", price: "₹620/hr" },

//   // Luxury Cars
//   { name: "Mercedes-Benz E-Class", image: "./src/img/mercedes-eclass.jpg", specs: "Luxury Sedan | 286 HP | Premium Features", price: "₹2,500/hr" },
//   { name: "BMW 5 Series", image: "./src/img/bmw-5series.jpg", specs: "Luxury Sedan | 252 HP | Sunroof & Tech", price: "₹2,700/hr" },
//   { name: "Audi Q7", image: "./src/img/audi-q7.jpg", specs: "Luxury SUV | 335 HP | Quattro AWD", price: "₹3,000/hr" },
//   { name: "Jaguar XF", image: "./src/img/jaguar-xf.jpg", specs: "Luxury Sedan | 247 HP | British Design", price: "₹2,800/hr" },
//   { name: "Volvo XC90", image: "./src/img/volvo-xc90.jpg", specs: "Luxury SUV | 400 HP | Hybrid & Safe", price: "₹3,200/hr" },

//   // Sports Cars
//   { name: "Ford Mustang GT", image: "./src/img/mustang.jpg", specs: "V8 | 450 HP | Muscle Car", price: "₹4,000/hr" },
//   { name: "Porsche 911 Carrera", image: "./src/img/porsche-911.jpg", specs: "Turbo | 379 HP | Sports Coupe", price: "₹5,500/hr" },
];

const Cars = () => {
  return (
    <>
      <CarNav />
      <div className="cars-container">
        {carData.map((car, index) => (
          <div key={index} className="car-card">
            <img src={car.image} alt={car.name} />
            <h3>{car.name}</h3>
            <p className="specs">{car.specs}</p>
            <p className="price">{car.price}</p>
            <button className="rent-btn">Details</button>
          </div>
        ))}
      </div>
    </>
  );
};

export default Cars;
