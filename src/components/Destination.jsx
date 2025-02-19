import { useState } from "react";
import "./Destination.css";
import { Link } from "react-router-dom";

const destinations = [
  {
    name: "Goa",
    image: "https://cdn.pixabay.com/photo/2017/01/20/00/30/beach-1993704_1280.jpg",
    description: "Goa is famous for its stunning beaches, vibrant nightlife, and Portuguese heritage. Enjoy water sports like parasailing and jet skiing at Baga Beach, explore historical churches such as the Basilica of Bom Jesus, and party at Tito’s Lane. Try Goan seafood and visit spice plantations for an aromatic experience.",
  },
  {
    name: "Jaipur",
    image: "/src/img/jaipur.jpg",
    description: "Jaipur, the Pink City, is known for its royal palaces and forts. Visit Amer Fort for its breathtaking architecture, City Palace for its regal history, and Hawa Mahal for a unique facade. Explore Johari Bazaar for traditional jewelry and handicrafts, and enjoy authentic Rajasthani cuisine at Chokhi Dhani.",
  },
  {
    name: "Manali",
    image: "/src/img/manali.jpg",
    description: "Manali is a paradise for nature lovers and adventure seekers. Explore the Solang Valley for skiing and paragliding, visit the famous Rohtang Pass for snow-covered landscapes, and relax at the hot springs in Vashisht. Trek to Hampta Pass for a breathtaking view of the Himalayas.",
  },
  {
    name: "Varanasi",
    image: "/src/img/varansi1.jpeg",
    description: "Varanasi, one of the world’s oldest cities, is a spiritual hub on the banks of the Ganges. Witness the mesmerizing Ganga Aarti at Dashashwamedh Ghat, visit the sacred Kashi Vishwanath Temple, and explore the narrow alleys filled with local street food. Take a boat ride at sunrise for a peaceful spiritual experience.",
  },
  {
    name: "Agra",
    image: "/src/img/agra.jpg",
    description: "Agra is home to the Taj Mahal, a UNESCO World Heritage Site and a symbol of eternal love. Visit the grand Agra Fort, explore Fatehpur Sikri’s historical architecture, and shop for marble souvenirs in the bustling markets. Don't miss trying the famous Agra Petha, a sweet delicacy.",
  },
  {
    name: "Mysore",
    image: "/src/img/Mysore.jpg",
    description: "Mysore is known for its rich history and cultural heritage. Visit the majestic Mysore Palace, climb Chamundi Hills to see the Chamundeshwari Temple, and enjoy the stunning Brindavan Gardens’ musical fountain show. Shop for Mysore silk sarees and savor the delicious Mysore Pak sweet.",
  },
  {
    name: "Darjeeling",
    image: "/src/img/DARJEELING.jpg",
    description: "Darjeeling is known for its breathtaking views of the Himalayas, lush tea gardens, and the famous Toy Train. Visit Tiger Hill for a stunning sunrise over Kanchenjunga, explore the Batasia Loop, and sip world-famous Darjeeling tea at a local tea estate. Don't miss the Peace Pagoda for a serene experience.",
  },
  {
    name: "Shimla",
    image: "/src/img/Shimla.jpg",
    description: "Shimla, the Queen of Hills, is a popular hill station with colonial charm. Walk along The Ridge, shop at Mall Road, and visit Jakhoo Temple for panoramic views. Enjoy skiing in Kufri during winter and take a scenic ride on the Kalka-Shimla Toy Train for a picturesque experience.",
  },
];

const PopularDestinations = () => {
  const [selectedDestination, setSelectedDestination] = useState(null);

  return (
    <div className={`destinations-container ${selectedDestination ? "blur-background" : ""}`}>
      <h2 className="destinations-title">Popular Destinations in India</h2>
      <div className="destinations-grid">
        {destinations.map((destination, index) => (
          <div
            key={index}
            className="destination-card"
            onClick={() => setSelectedDestination(destination)}
          >
            <img src={destination.image} alt={destination.name} />
            <h3>{destination.name}</h3>
          </div>
        ))}
      </div>

      {selectedDestination && (
        <div className="modal">
          <div className="modal-content">
            <span className="close-btn" onClick={() => setSelectedDestination(null)}>
              &times;
            </span>
            <img src={selectedDestination.image} alt={selectedDestination.name} />
            <h3>{selectedDestination.name}</h3>
            <p>{selectedDestination.description}</p>
          </div>
        </div>
      )}

      {/* Button to navigate to '/md' */}
      <Link to="/md">
        <button className="more-destination">More Destinations</button>
      </Link>
    </div>
  );
};

export default PopularDestinations;
