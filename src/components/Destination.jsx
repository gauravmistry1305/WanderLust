import "./Destination.css";

const destinations = [
  {
    name: "Goa",
    image: "https://cdn.pixabay.com/photo/2017/01/20/00/30/beach-1993704_1280.jpg",
  },
  {
    name: "Jaipur, Rajasthan",
    image: "/src/img/jaipur.jpg",
  },
  {
    name: "Manali, Himachal Pradesh",
    image: "/src/img/manali.jpg",
  },
  {
    name: "Varanasi, Uttar Pradesh",
    image: "/src/img/varansi1.jpeg",
  },
  {
    name: "Agra, Uttar Pradesh",
    image: "/src/img/agra.jpg",
  },
  {
    name: "Mysore, Karnataka",
    image: "/src/img/mysore.jpg",
  },
  {
    name: "Darjeeling, West Bengal",
    image: "src/img/darjeeling.jpg",  
  },
  {
    name: "Shimla, Himachal Pradesh",
    image: "/src/img/shimla.jpg",
  },
];

const PopularDestinations = () => {
  return (
    <div className="destinations-container">
      <h2 className="destinations-title">Popular Destinations in India</h2>
      <div className="destinations-grid">
        {destinations.map((destination, index) => (
          <div key={index} className="destination-card">
            <img src={destination.image} alt={destination.name} />
            <h3>{destination.name}</h3>
          </div>
        ))}
      </div>
    </div>
  );
};

export default PopularDestinations;
