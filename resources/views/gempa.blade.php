<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tugas Praktikum</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link href="{{ asset('css/peta/peta.css') }}" rel="stylesheet">
</head>

<body>
  <div id="map"></div>
</body>

<script>
  document.addEventListener('DOMContentLoaded', async () => {
    const map = L.map('map').setView([-2, 117], 5);

    renderMap(map)
    await renderMarker(map);
  })

  async function fetchEarthquake() {
    try {
      const response = await fetch('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json');

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return response.json();
    } catch (error) {
      console.error('Something went wrong with fetch:', error);
    }
  }

  async function renderMarker(map) {
    try {
      const response = await fetchEarthquake();
      if (response) {
        const earthquakes = response.Infogempa.gempa;
        let numberQuake = 1;

        earthquakes.forEach(quake => {
          const {
            Tanggal
            , Jam
            , Coordinates
            , Magnitude
            , Kedalaman
            , Wilayah
            , Potensi
          } = quake;
          const coordinates = Coordinates.split(',');
          const latitude = parseFloat(coordinates[0]);
          const longitude = parseFloat(coordinates[1]);

          const splitedWilayah = Wilayah.split(' ');
          const wilayah = `
                ${splitedWilayah[2]
                    .match(/[A-Z][a-z]*/g)
                    .join(' ')
                } -
                ${splitedWilayah[3]
                    .split('-')
                    .join(' ')
                }
            `

          const popupContent = `
            <h3>Gempa Ke ${numberQuake}</h3>
            <p>
                Wilayah: ${wilayah}<br>
                Waktu: ${Tanggal}, ${Jam}<br>
                Kedalaman: ${Kedalaman}<br>
                Kekuatan: ${Magnitude} SR<br>
                Potensi: ${Potensi}
            </p>
          `;

          L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup(popupContent);

          numberQuake++;
        });
      } else {
        console.error('No data available');
      }
    } catch (error) {
      console.error('Error in renderMarker:', error);
    }
  }

  function renderMap(map) {
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19
      , attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    , }).addTo(map);
  }

</script>
</html>
