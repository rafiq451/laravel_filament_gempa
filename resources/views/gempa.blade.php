<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 600px; }
        h1, h3 {
            text-align: center
        }
    </style>
     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
    <body>
        <h1>Peta Gempa Bumi</h1>
        <h3>Sumber dari : BMKG</h3>
        <div id="map"></div>
        <script>
            var map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{ maxZoom: 10,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let files = {!! file_get_contents("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json") !!}
            
            let gempas = files.Infogempa.gempa;
            
            gempas.forEach(gempas => {
                let titik = gempas.Coordinates.split(",");
                let lat = titik[0];
                let log = titik[1];
    
                // untuk menampilkan titik koordinasi gempa
                let marker = L.marker([lat, log]).addTo(map);
                console.log(marker);

                // untuk menampilkan informasi gempa
                marker.bindPopup(
                `Wilayah : ${gempas.Wilayah} <br>`
                 +`Tanggal : ${gempas.Tanggal} <br>`
                 + `Jam : ${gempas.Jam} <br>`
                 + `Kekuatan : ${gempas.Magnitude} <br>`
                 + `Potensi : ${gempas.Potensi} <br>`

                )
              
            });

        </script>
    </body>
</html>