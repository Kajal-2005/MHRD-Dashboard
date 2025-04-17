// Function to update the current time
function updateTime() {
    let now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let ampm = hours >= 12 ? "PM" : "AM";
    hours = hours % 12 || 12; // Convert to 12-hour format
    minutes = minutes < 10 ? "0" + minutes : minutes;
    let timeString = `24 Mar, 2025 | ${hours}:${minutes} ${ampm} IST`;
    document.getElementById("current-time").innerText = timeString;
}

// Function to handle search button click
document.getElementById("search-button").addEventListener("click", function() {
    let query = document.getElementById("search-input").value;
    if (query) {
        alert("Searching for: " + query);
        // Replace with actual search functionality
    }
});

// Update time every second
setInterval(updateTime, 1000);
updateTime(); // Initial call to display time immediately

// Slideshow
// Slideshow functionality
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.opacity = i === index ? "1" : "0";
    });
}

// Auto-slide every 3 seconds
function startSlideshow() {
    setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }, 3000);
}

// Initialize slideshow
startSlideshow();

//update-section 

document.querySelectorAll('.link-confirmation').forEach(link => {
        link.addEventListener('click', function(event) {
            const confirmNavigation = confirm("You are about to visit another page. Do you want to proceed?");
                if (!confirmNavigation) {
                    event.preventDefault(); // Stops navigation if user clicks "Cancel"
                }
    });
});


// Map
const indiaBounds = [
    [6, 68],
    [36, 98]    
];

const map = L.map('indiaMap').fitBounds(indiaBounds);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18,
}).addTo(map);

// Sample literacy data (you can replace or extend this)
const literacyData = [
  {
    state: 'Delhi',
    lat: 28.6139,
    lng: 77.2090,
    literacy: '86.2%',
  },
  {
    state: 'Maharashtra (Mumbai)',
    lat: 19.0760,
    lng: 72.8777,
    literacy: '89.7%',
  },
  {
    state: 'Tamil Nadu (Chennai)',
    lat: 13.0827,
    lng: 80.2707,
    literacy: '80.3%',
  },
  {
    state: 'West Bengal (Kolkata)',
    lat: 22.5726,
    lng: 88.3639,
    literacy: '76.3%',
  },
  {
    state: 'Bihar (Patna)',
    lat: 25.5941,
    lng: 85.1376,
    literacy: '70.7%', // Sample data
},
{
    state: 'Madhya Pradesh (Bhopal)',
    lat: 23.2599,
    lng: 77.4126,
    literacy: '80.9%', // Sample data
},
{
    state: 'Kerala (Thiruvananthapuram)',
    lat: 8.5241,
    lng: 76.9366,
    literacy: '96.2%', // Sample data - Kerala has high literacy!
}
];

// Add markers for each state
literacyData.forEach((location) => {
  L.marker([location.lat, location.lng])
    .addTo(map)
    .bindPopup(`<b>${location.state}</b><br>Literacy Rate: ${location.literacy}`);
});
window.addEventListener('resize', function() {
    map.invalidateSize();
});

// Search box
    document.getElementById("searchInput").addEventListener("input", function () {
        const query = this.value.toLowerCase();
        const blocks = document.querySelectorAll(".content-block");

        blocks.forEach(block => {
            const text = block.textContent.toLowerCase();
            block.style.display = text.includes(query) ? "block" : "none";
        });
    });





