<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
    <div id="map"></div>
    <input id="longitude" name="longitude" type="float" class="form-control d-none" placeholder="Longitude">
    <input id="latitude" name="latitude" type="float" class="form-control d-none" placeholder="Latitude">
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        $(document).ready(function(){
            var map = L.map('map').setView([33.9, 10.0], 9); 
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            var marker;
            map.on('click', function(event){
                if(marker){
                    map.removeLayer(marker);
                }
                marker = L.marker([Object.values(event.latlng)[0], Object.values(event.latlng)[1]]).addTo(map);
                lat.value = Object.values(event.latlng)[0];
                lng.value = Object.values(event.latlng)[1];
            });
        });
    </script>