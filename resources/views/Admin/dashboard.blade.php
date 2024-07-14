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
                                    <h4 class="card-title">Vous pouvez visualiser ou modifier des informations concernant le materiel AirPon</h4>
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
                                                        <i data-toggle="popover" title="<strong>EndBox</strong>" data-container="body" data-html="true" data-content="<strong>Nom:</strong> {{ $chaine['endBox']->nom }}<br><strong>Modèle:</strong> {{ $chaine['endBox']->modele }}<br><strong>Adresse:</strong> {{ $chaine['endBox']->adresse }}<br>" class="fas fa-box equipment-icon"></i>
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

    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html: true,
                placement: 'left',
                trigger: 'hover'
            });

            var map = L.map('map').setView([33.9, 10.0], 9); 
            
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
                L.marker([{{ $chaine['olt']->longitude }}, {{ $chaine['olt']->latitude }}], {icon: icon})
                    .addTo(map)
                    .bindPopup("<b>{{ $chaine['olt']->nom }}</b><br>Type: {{ $chaine['olt']->type }}<br>Modèle: {{ $chaine['olt']->modele }}");
            @endforeach

            // var group = new L.featureGroup(map._layers);
            // map.fitBounds(group.getBounds().pad(0.1));
        });
    </script>

</body>
</html>