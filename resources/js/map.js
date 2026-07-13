import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

document.addEventListener('DOMContentLoaded', () => {

    const mapContainer = document.getElementById('worldMap');

    if (!mapContainer) return;

    const countries = window.countries || [];

    console.log("Countries:", countries);

    const map = L.map('worldMap');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const bounds = [];

    countries.forEach(country => {

        // Lewati jika koordinat kosong
        if (
            country.latitude == null ||
            country.longitude == null ||
            country.latitude === "" ||
            country.longitude === ""
        ) {
            return;
        }

        const lat = parseFloat(country.latitude);
        const lng = parseFloat(country.longitude);

        bounds.push([lat, lng]);

        let color = "#22c55e"; // LOW

        if (country.risk === "MEDIUM") {
            color = "#facc15";
        }

        if (country.risk === "HIGH") {
            color = "#ef4444";
        }

        L.circleMarker([lat, lng], {
            radius: 10,
            color: "#ffffff",
            weight: 2,
            fillColor: color,
            fillOpacity: 1
        })
        .addTo(map)
        .bindPopup(`
            <div class="popup-card">

                <div class="popup-title">
                    🌍 ${country.name}
                </div>

                <div class="popup-risk">
                    ${country.risk}
                </div>

                <div class="popup-item">
                    <span>📈 GDP</span>
                    <span>${country.gdp}%</span>
                </div>

                <div class="popup-item">
                    <span>📉 Inflation</span>
                    <span>${country.inflation}%</span>
                </div>

                <div class="popup-item">
                    <span>🌦 Weather</span>
                    <span>${country.weather}</span>
                </div>

                <div class="popup-item">
                    <span>⚓ Port</span>
                    <span>${country.port}</span>
                </div>

            </div>
        `);

    });

    // Zoom ke semua marker
    if (bounds.length > 0) {
        map.fitBounds(bounds, {
            padding: [50, 50]
        });
    } else {
        // Jika tidak ada marker
        map.setView([-2.5, 118], 5);
    }

});

console.log("MAP.JS LOADED");