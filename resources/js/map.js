window.addEventListener("load", () => {

    if (typeof L === "undefined") {
        console.log("Leaflet gagal dimuat");
        return;
    }

    const el = document.getElementById("worldMap");

    if (!el) {
        console.log("worldMap tidak ditemukan");
        return;
    }

    const map = L.map("worldMap").setView([20, 0], 2);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "&copy; OpenStreetMap"
    }).addTo(map);

    // Marker negara
    if (window.countries) {

        window.countries.forEach(country => {

            let color = "#16a34a";

            if (country.risk === "MEDIUM") color = "#facc15";
            if (country.risk === "HIGH") color = "#ef4444";

            L.circleMarker(
                [country.latitude, country.longitude],
                {
                    radius: 8,
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.9
                }
            )
            .addTo(map)
            .bindPopup(`
                <b>${country.name}</b><br>
                Risk : ${country.risk}<br>
                GDP : ${country.gdp}%<br>
                Inflation : ${country.inflation}%
            `);

        });

    }

});