const destinations = [
     { name: "Goa", image: "https://cdn.pixabay.com/photo/2017/01/20/00/30/beach-1993704_1280.jpg", description: "Goa – Known for its stunning beaches, vibrant nightlife, and Portuguese heritage, Goa is a paradise for tourists. It offers adventure sports like parasailing, jet skiing, and scuba diving. North Goa is famous for its party culture, while South Goa is known for serene beaches and luxury resorts. Historic churches, spice plantations, and delicious seafood add to its charm.." },
   
     { name: "Jaipur", image: "/src/img/jaipur.jpg", description: "Jaipur – The Pink City, Jaipur, is the capital of Rajasthan and a hub of royal heritage. It is home to iconic landmarks like Amer Fort, Hawa Mahal, and City Palace. The bustling bazaars sell handicrafts, jewelry, and traditional Rajasthani attire. The city’s architecture reflects Rajput and Mughal influences. A visit to Jaipur is incomplete without trying Dal Baati Churma and Ghewar.." },
   
     { name: "Manali", image: "/src/img/manali.jpg", description: "Manali – A picturesque hill station in Himachal Pradesh, Manali is known for its snow-capped mountains and adventure activities. Rohtang Pass and Solang Valley offer skiing, paragliding, and trekking. Hidimba Devi Temple and Manu Temple highlight its spiritual side. The Beas River enhances the town’s beauty, making it a perfect getaway.." },
   
     { name: "Varanasi", image: "/src/img/varansi1.jpeg", description: "Varanasi – One of the oldest cities in the world, Varanasi is a spiritual hub on the banks of the Ganges. The ghats, like Dashashwamedh and Assi, are famous for evening Aarti rituals. Kashi Vishwanath Temple is a major religious site. The city is also known for Banarasi silk sarees and mouth-watering street food.." },
   
     { name: "Agra", image: "/src/img/agra.jpg", description: "Agra – Home to the Taj Mahal, Agra is a symbol of Mughal grandeur. Agra Fort and Fatehpur Sikri reflect its historical richness. The city is famous for its marble handicrafts and Petha, a local sweet. A UNESCO World Heritage Site, the Taj Mahal attracts millions of visitors.." },
   
     { name: "Mysore", image: "/src/img/Mysore.jpg", description: "Mysore – Known as the City of Palaces, Mysore is famous for the grand Mysore Palace. Chamundi Hill Temple offers panoramic views of the city. The city’s rich heritage is showcased in its art, silk sarees, and sandalwood products. Mysore Dasara is a major festival that attracts visitors.." },
   
     { name: "Darjeeling", image: "/src/img/DARJEELING.jpg", description: "Darjeeling – Nestled in the Himalayas, Darjeeling is famous for its tea gardens and scenic views. The Toy Train, a UNESCO World Heritage Site, offers a nostalgic ride. Tiger Hill is the best spot to witness a breathtaking sunrise. The city has a mix of Tibetan, Nepali, and British influences.." },
   
     { name: "Shimla", image: "/src/img/Shimla.jpg", description: "Shimla – The Queen of Hills, Shimla is a popular hill station known for its colonial charm. The Ridge, Mall Road, and Jakhoo Temple are key attractions. Kufri offers adventure activities like skiing and horse riding. The Toy Train ride from Kalka to Shimla is a memorable experience.." },
   
     { name: "Udaipur", image: "/src/img/Udaipur1.webp", description: "Udaipur – The City of Lakes, Udaipur, is known for its beautiful palaces and romantic boat rides. City Palace, Lake Pichola, and Jag Mandir are must-visit sites. The city showcases vibrant Rajasthani culture with folk music and dance. Its rich history and stunning landscapes make it a top travel destination.." },
   
     { name: "Rishikesh", image: "/src/img/rishikesh.jpeg", description: "Rishikesh – A spiritual and adventure hub, Rishikesh is known for yoga, river rafting, and serene ashrams. Laxman Jhula and Ram Jhula are iconic suspension bridges. The Ganga Aarti at Triveni Ghat is a mesmerizing experience. It is also the gateway to the Char Dham Yatra.." },
   
     { name: "Ooty", image: "/src/img/Ooty1.webp", description: "Ooty – A charming hill station in Tamil Nadu, Ooty is famous for its botanical gardens and tea estates. The Nilgiri Mountain Railway offers a scenic train ride. Boating at Ooty Lake and visiting Doddabetta Peak are popular activities. The cool climate and lush greenery make it a favorite summer retreat.." },
   
     { name: "Kolkata", image: "/src/img/Kolkata.webp", description: "Kolkata – The City of Joy, Kolkata, is known for its colonial architecture and cultural richness. Victoria Memorial, Howrah Bridge, and Dakshineswar Temple are key landmarks. The city is famous for its literary heritage and Durga Puja celebrations. Street food like Kathi rolls and Mishti Doi is a must-try.." },
   
     { name: "Pondicherry", image: "/src/img/pondicherry.jpg", description: "Pondicherry – A former French colony, Pondicherry offers a blend of European charm and Indian culture. The French Quarter, Aurobindo Ashram, and Rock Beach are highlights. The city has a laid-back vibe with cafes and cycling-friendly streets. Serenity Beach is ideal for surfing and relaxation.." },
   
     { name: "Amritsar", image: "/src/img/Amritsar.jpg", description: "Amritsar – Home to the Golden Temple, Amritsar is a spiritual and historical city. The Wagah Border ceremony showcases Indo-Pak patriotism. Jallianwala Bagh is a reminder of India’s freedom struggle. Punjabi cuisine, including Amritsari Kulcha and Lassi, is a delight.." },
   
     { name: "Mumbai", image: "/src/img/Mumbai.webp", description: "Mumbai – The City of Dreams, Mumbai is India’s financial and entertainment hub. Iconic landmarks include Gateway of India, Marine Drive, and Elephanta Caves. Bollywood adds to the city’s glamour. Mumbai is also famous for its street food, such as Vada Pav and Pav Bhaji.." },
   
     { name: "Chennai", image: "/src/img/chennai.jpg", description: "Chennai – The cultural capital of South India, Chennai is known for its temples and Marina Beach. The Dravidian architecture of Kapaleeshwarar Temple is remarkable. The city is famous for classical music and Bharatanatyam dance. South Indian filter coffee and dosas are a must-try.." },
     
     { name: "Bangalore", image: "/src/img/Banglore.jpg", description: "Bangalore – India’s IT hub, Bangalore is a blend of modernity and heritage. The city is famous for Lalbagh Garden, Bangalore Palace, and vibrant nightlife. It is also a gateway to hill stations like Coorg and Chikmagalur. The pleasant climate makes it a year-round destination." },
   
     { name: "Hyderabad", image: "/src/img/Hyderabad.jpg", description: "Hyderabad – The City of Pearls, Hyderabad is famous for Charminar and Golconda Fort. The Ramoji Film City is a popular attraction. Hyderabadi Biryani is a culinary delight. The city has a rich blend of Mughal and Nizami culture.." },
   
     { name: "Kochi", image: "/src/img/Kochi.webp", description: "Kochi – A charming port city, Kochi has colonial influences and backwater cruises. The Chinese fishing nets are iconic. Fort Kochi offers a mix of Portuguese, Dutch, and British heritage. Kerala’s traditional Kathakali dance is a major attraction.." },
   
     { name: "Ajanta & Ellora", image: "/src/img/Ajanta-Ellora.jpg", description: "Ajanta & Ellora – These UNESCO-listed caves are known for their Buddhist, Hindu, and Jain art. Ajanta showcases ancient frescoes, while Ellora has rock-cut temples. The Kailasa Temple at Ellora is a masterpiece of architecture." },
   
     { name: "Hampi", image: "/src/img/Hampi.jpg", description: "Hampi – A UNESCO World Heritage Site, Hampi is known for its stunning ruins and temples. The Virupaksha Temple and Vijaya Vittala Temple are must-visit spots. The rocky landscapes and Tungabhadra River add to its beauty.." },
   
     { name: "Jaisalmer", image: "/src/img/Jaiselmer.jpg", description: "Jaisalmer – The Golden City, Jaisalmer is known for its desert fort and camel safaris. The intricate Havelis showcase Rajasthani craftsmanship. The Sam Sand Dunes offer a true desert experience.." },
   
     { name: "Khajuraho", image: "/src/img/Khajuraho.jpg", description: "Khajuraho – Famous for its exquisite temples with erotic sculptures. The temples depict India’s ancient artistic heritage. Light and sound shows narrate the history of the temples.." },
   
     { name: "Kanyakumari", image: "/src/img/Kanyakumari.webp", description: "Kanyakumari – The southernmost tip of India, known for its stunning sunrise views. The Vivekananda Rock Memorial is a spiritual site. The confluence of three seas adds to its significance.." },
   
     { name: "Ranthambore", image: "/src/img/ranthambhore.webp", description: "Ranthambore – A famous tiger reserve in Rajasthan. The Ranthambore Fort and wildlife safaris are highlights. Spotting the Bengal tiger is a major attraction.." },
   
     { name: "Kaziranga", image: "/src/img/Kaziranga.webp", description: "Kaziranga – A UNESCO-listed national park in Assam. Home to the one-horned rhinoceros and diverse birdlife. The park’s grasslands make it ideal for safaris.." },
   
     { name: "Munnar", image: "/src/img/Munnar.jpg", description: "Munnar – A hill station in Kerala known for tea plantations. The Eravikulam National Park is home to the Nilgiri Tahr. Waterfalls and lush greenery make it a nature lover’s paradise.." },
   
     { name: "Andaman & Nicobar", image: "/src/img/andaman-nicobar.png", description: "Andaman & Nicobar – A tropical paradise with pristine beaches. Radhanagar Beach and Cellular Jail are key attractions. Snorkeling and scuba diving in the coral reefs are popular.." }
   ];     
 
 const app = document.getElementById("app");
 
 function renderDestinations() {
     const container = document.createElement("div");
     container.classList.add("destinations-container");
 
     destinations.forEach((destination, index) => {
         const card = document.createElement("div");
         card.classList.add("destination-card");
 
         card.innerHTML = `
             <img src="${destination.image}" alt="${destination.name}">
             <h3>${destination.name}</h3>
         `;
 
         card.addEventListener("click", () => showModal(destination));
 
         container.appendChild(card);
     });
 
     app.appendChild(container);
 }
 
 function showModal(destination) {
     const modal = document.createElement("div");
     modal.classList.add("destimodal");
 
     modal.innerHTML = `
         <div class="destimodal-content">
             <span class="close-btn">&times;</span>
             <img src="${destination.image}" alt="${destination.name}">
             <h3>${destination.name}</h3>
             <p>${destination.description}</p>
             <button class="book-btn"><a href="/packages">Book Now</a></button>
         </div>
     `;
 
     modal.querySelector(".close-btn").addEventListener("click", () => {
         modal.remove();
     });
 
     document.body.appendChild(modal);
 }
 
 renderDestinations();
 