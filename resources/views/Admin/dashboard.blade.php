<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Espace Administrateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
        .equipment-chain {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .equipment-icon {
            font-size: 2rem;
            margin: 0 10px;
            cursor: pointer;
        }
        .arrow-icon {
            font-size: 1.5rem;
            color: #6c757d;
        }
        #map {
            height: 400px;
            width: 100%;
            margin-bottom: 20px;
        }
        .leaflet-control-radius {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.65);
            padding: 5px 10px;
            font-size: 14px;
        }

        .leaflet-control-radius .radius-slider-container {
            display: flex;
            align-items: center;
            width: 200px;
        }

        .leaflet-control-radius-slider-label {
            margin-right: 5px;
            white-space: nowrap;
        }

        .leaflet-control-radius-slider {
            flex-grow: 1;
            -webkit-appearance: none;
            height: 5px;
            background: #ddd;
            outline: none;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .leaflet-control-radius-slider:hover {
            opacity: 1;
        }

        .leaflet-control-radius-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #888;
            cursor: pointer;
        }

        .leaflet-control-radius-slider::-moz-range-thumb {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #888;
            cursor: pointer;
        }
    </style>
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- ========== Navbar Start ========== -->
        @include('Admin/layout/navbar')
        @include('Admin/layout/sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Carte des équipements AirPon</h4>
                                    <div id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Visualiser des informations concernant le materiel AirPon</h4>
                                    <br />

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6 mx-auto">
                                                @foreach ($chaines as $chaine)
                                                    <div class="equipment-chain">
                                                        <i class="fas fa-server equipment-icon" data-toggle="popover" data-trigger="hover" title="<b>OLT</b>" data-content="<strong>Nom:</strong> {{ $chaine['olt']->nom }}<br><strong>Type:</strong> {{ $chaine['olt']->type }}<br><strong>Modèle:</strong> {{ $chaine['olt']->modele }}<br><strong>Adresse:</strong> {{ $chaine['olt']->adresse }}<br><strong>Centrale Optique:</strong> {{ $chaine['olt']->centrale_optique }}<br><strong>Numéro Slot Board:</strong> {{ $chaine['olt']->numero_slot_board }}<br><strong>Date Mise en Service:</strong> {{ $chaine['olt']->date_mise_service }}<br><strong>Hub ID:</strong> {{ $chaine['olt']->hub_id }}<br><strong>Coordonnées:</strong> ({{ $chaine['olt']->longitude }}, {{ $chaine['olt']->latitude }})<br><strong>Capacité en Port:</strong> {{ $chaine['olt']->capacite_en_port }}"></i>
                                                        <i class="fas fa-arrow-right arrow-icon"></i>
                                                        <i data-toggle="popover" title="<strong>Hub</strong>" data-container="body" data-html="true" data-content="<strong>Nom:</strong> {{ $chaine['hub']->nom }}<br><strong>Modèle:</strong> {{ $chaine['hub']->modele }}<br><strong>Adresse:</strong> {{ $chaine['hub']->adresse }}<br>" class="fab fa-hubspot equipment-icon"></i>
                                                        <i class="fas fa-arrow-right arrow-icon"></i>
                                                        @foreach ($chaine['subBoxs'] as $subBox)
                                                            <i data-toggle="popover" title="<strong>SubBox</strong>" data-container="body" data-html="true" data-content="<strong>Nom:</strong> {{ $subBox->nom }}<br><strong>Modèle:</strong> {{ $subBox->modele }}<br><strong>Adresse:</strong> {{ $subBox->adresse }}<br>" class="fas fa-boxes equipment-icon"></i>
                                                            <i class="fas fa-arrow-right arrow-icon"></i>
                                                        @endforeach
                                                        <i data-toggle="popover" title="<strong>EndBox</strong>" data-container="body" data-html="true" data-content="<strong>Nom:</strong> {{ $chaine['endBox']->nom ?? "---" }}<br><strong>Modèle:</strong> {{ $chaine['endBox']->modele ?? "---" }}<br><strong>Adresse:</strong> {{ $chaine['endBox']->adresse ?? "---" }}<br>" class="fas fa-box equipment-icon"></i>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Page-content -->

            <!-- ========== Footer Start ========== -->
            @include('Admin/layout/footer')
            <!-- Footer End -->
        </div>
    </div>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html: true,
                placement: 'left',
                trigger: 'hover'
            });
    
            var map = L.map('map').setView([33.9, 10.0], 9); 
    
            // Circle test
            var radius = 200;
            var circle = L.circle([33.88395, 10.09328], { radius: radius }).addTo(map);

            circle.on('mousedown', function() {
                map.dragging.disable();
                map.on('mousemove', function(e) {
                    circle.setLatLng(e.latlng);
                    updateMarkerVisibility();
                });
            });

            map.on('mouseup', function() {
                map.dragging.enable();
                map.off('mousemove');
            });

            var markers = [];

            function isMarkerInsideCircle(marker, circle) {
                var circleLatLng = circle.getLatLng();
                var markerLatLng = marker.getLatLng();
                return circleLatLng.distanceTo(markerLatLng) <= circle.getRadius();
            }

            function updateMarkerVisibility() {
                markers.forEach(function(marker) {
                    if (isMarkerInsideCircle(marker, circle)) {
                        marker.addTo(map);
                    } else {
                        marker.remove();
                    }
                });
            }

            L.Control.RadiusSlider = L.Control.extend({
                options: {
                    position: 'topright'
                },

                onAdd: function (map) {
                    var controlName = 'leaflet-control-radius';
                    var container = L.DomUtil.create('div', controlName + ' leaflet-bar leaflet-control');
                    var options = this.options;

                    this._container = container;

                    this._sliderContainer = L.DomUtil.create('div', 'radius-slider-container', container);
                    var slider = this._createSlider(controlName + '-slider', this._sliderContainer, this._updateRadius);
                    this._slider = slider;

                    L.DomEvent.disableClickPropagation(container);

                    return container;
                },

                _createSlider: function (className, container, fn) {
                    var sliderContainer = L.DomUtil.create('div', className + '-container', container);
                    var label = L.DomUtil.create('span', className + '-label', sliderContainer);
                    label.innerHTML = 'Radius: ';
                    var slider = L.DomUtil.create('input', className, sliderContainer);
                    slider.type = 'range';
                    slider.min = 100;
                    slider.max = 100000;
                    slider.step = 100;
                    slider.value = radius;

                    L.DomEvent.on(slider, 'input', fn, this);

                    return slider;
                },

                _updateRadius: function (e) {
                    radius = parseInt(e.target.value);
                    circle.setRadius(radius);
                    updateMarkerVisibility();
                }
            });

            var radiusSlider = new L.Control.RadiusSlider();
            radiusSlider.addTo(map);
            // circle test end
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
    
            var customIcon = L.Icon.extend({
                options: {
                    iconSize:     [25, 41],
                    iconAnchor:   [12, 41],
                    popupAnchor:  [1, -34],
                    shadowSize:   [41, 41]
                }
            });
    
            var redIcon = new customIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png'}),
                blueIcon = new customIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png'}),
                greenIcon = new customIcon({iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png'});
    
            @foreach ($chaines as $index => $chaine)
                var icon;
                if ({{ $index }} % 3 == 0) {
                    icon = redIcon;
                } else if ({{ $index }} % 3 == 1) {
                    icon = blueIcon;
                } else {
                    icon = greenIcon;
                }
                var marker = L.marker([{{ $chaine['olt']->longitude }}, {{ $chaine['olt']->latitude }}], {icon: icon})
                    .bindPopup("<b>{{ $chaine['olt']->nom }}</b><br>Type: {{ $chaine['olt']->type }}<br>Modèle: {{ $chaine['olt']->modele }}");
                markers.push(marker);
            @endforeach

            // ad the routing (to modify so that it activates once the olt is clicked and shows the hubs, the subs and the endbox connected to that olt)
            L.Routing.control({
                waypoints: [
                    L.latLng(markers[0].getLatLng()),
                    L.latLng(33.88395, 10.09)
                ],
                routeWhileDragging: true,
            }).addTo(map);
            document.querySelector('.leaflet-routing-container').style.display = 'none';
    
            updateMarkerVisibility();
    
            // var group = new L.featureGroup(map._layers);
            // map.fitBounds(group.getBounds().pad(0.1));
        });
    </script>

</body>
</html>