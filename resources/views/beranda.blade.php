<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tugas Praktikum</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    #map {
      height: 100vh;
    }

  </style>
</head>

<body>
  <div id="map"></div>

  <script>
    const provinces = @json($list_province);
    const map = L.map('map').setView([-2, 117], 5);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19
      , attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    , }).addTo(map);

    function marker(province) {
      L.marker([province.latitude, province.longitude]).addTo(map).bindPopup(
        `<b>${province.province_name}</b></br></br>latitude: ${province.latitude}</br>longitude: ${province.longitude}`
      );
    }

    provinces.forEach(province => marker(province));

  </script>
</body>
</html>
