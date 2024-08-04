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
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #map {
            height: 500px;
            position: relative;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
        .leaflet-routing-container {
            display: none;
        }
        .myModal {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: white;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            max-width: 300px;
            width: 100%;
            max-height: 100%;
            overflow-y: auto;
        }
        .modal-content {
            margin: 0;
        }
        .close {
            float: right;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-control {
            width: 100%;
            padding: 5px;
        }
    </style>
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Navbar Start -->
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
                                <h4 class="mb-sm-0 font-size-18">Chaine AIRPON</h4>
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
                </div>
            </div>
            <!-- End Page-content -->

            <!-- Footer Start -->
            @include('Admin/layout/footer')
            <!-- Footer End -->
        </div>
    </div>
    <!-- OLT Modal -->
    <div id="oltModal" class="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>OLT Information</h3>
            <form id="oltForm" action="">
                @csrf
                <div class="row mb-4">
                    <label for="nom" class="col-form-label col-lg-2">Nom</label>
                    <div class="col-lg-10">
                        <input id="nom" name="nom" type="text" class="form-control" placeholder="Entrer le nom">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="type" class="col-form-label col-lg-2">Type</label>
                    <div class="col-lg-10">
                        <input id="type" name="type" type="text" class="form-control" placeholder="Entrer le type">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="modele" class="col-form-label col-lg-2">Modèle</label>
                    <div class="col-lg-10">
                        <input id="modele" name="modele" type="text" class="form-control" placeholder="Entrer le modèle">
                    </div>
                </div>
                {{-- <div class="row mb-4">
                    <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                    <div class="col-lg-10">
                    </div>
                </div> --}}
                <div class="row mb-4">
                    <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                    <div class="col-lg-10">
                        <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Entrer l'adresse">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="centrale_optique" class="col-form-label col-lg-2">Centrale Optique</label>
                    <div class="col-lg-10">
                        <input id="centrale_optique" name="centrale_optique" type="text" class="form-control" placeholder="Entrer la centrale optique">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="num_slot_board" class="col-form-label col-lg-2">Numéro de Slot Board</label>
                    <div class="col-lg-10">
                        <input id="num_slot_board" name="num_slot_board" type="number" class="form-control" placeholder="Entrer le numéro de slot board">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="capacite_en_port" class="col-form-label col-lg-2">Capacite En Port</label>
                    <div class="col-lg-10">
                        <input id="capacite_en_port" name="capacite_en_port" type="text" class="form-control" placeholder="Entrer le numéro de slot board">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="date_mise_service" class="col-form-label col-lg-2">Date de Mise en Service</label>
                    <div class="col-lg-10">
                        <input id="date_mise_service" name="date_mise_service" type="datetime-local" class="form-control" placeholder="Entrer la date de mise en service">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="carte_id" class="col-form-label col-lg-2 d-flex align-items-center">
                        Carte 
                        <button type="button" class="btn btn-primary btn-sm ms-2" onclick="modifyOLT()">+</button>
                    </label>
                    <div class="col-lg-10">
                        <div id="carte_div" class="row">
                            <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                                <select id="carte_id" name="carte_id[]" class="form-control" onchange="checkAndDeleteEmptyOptions(this)">
                                    <option value="">-- Sélectionner carte --</option>
                                    @foreach ($cartes as $newCarte)
                                        <option value="{{ $newCarte->id }}">
                                            {{ $newCarte->modele_carte }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" id="concatenated_values" name="concatenated_values" value="" class="d-none">                                     
                <div class="row justify-content-end">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary">Ajouter OLT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Hub Modal -->
    <div id="hubModal" class="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Hub Information</h3>
            <form id="hubForm" action="">
                @csrf
                <div class="row mb-4">
                    <label for="nom" class="col-form-label col-lg-2">Nom</label>
                    <div class="col-lg-10">
                        <input id="nom" name="nom" type="text" class="form-control" placeholder="Entrer le nom">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="num_serie" class="col-form-label col-lg-2">Numero Serie</label>
                    <div class="col-lg-10">
                        <input id="num_serie" name="num_serie" type="text" class="form-control" placeholder="Entrer le numero serie">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="modele" class="col-form-label col-lg-2">Modèle</label>
                    <div class="col-lg-10">
                        <input id="modele" name="modele" type="text" class="form-control" placeholder="Entrer le modèle">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="ports_affecte" class="col-form-label col-lg-2">Ports Affectes</label>
                    <div class="col-lg-10">
                        <input id="ports_affecte" name="ports_affecte" type="text" class="form-control d-none" placeholder="Entrer les ports affectes">
                        <div class="row justify-content-around">
                            @php
                                $ports = [1, 2, 3, 4, 5, 6, 7, 8];
                            @endphp
                            <div class="row justify-content-around">
                                @foreach ($ports as $port)
                                    <label id="btn_{{ $port }}" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <input onclick="add({{ $port }})" type="checkbox" class="d-none">
                                        @if ($port < 10)
                                            <i class="fa-solid fa-{{ $port }}"></i>
                                        @else
                                            <i class="fa-solid fa-{{ floor($port / 10) }}"></i><i class="fa-solid fa-{{ $port % 10 }}"></i>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                    <div class="col-lg-10">
                        <input id="adresse" name="adresse" type="text" class="form-control" placeholder="Entrer l'adresse'">
                    </div>
                </div>
                {{-- <div class="row mb-4">
                    <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                    <div class="col-lg-10">
                            @include('Admin/mapDiv')
                    </div>
                </div> --}}
                <div class="row mb-4">
                    <label for="nbr_chaine_actif" class="col-form-label col-lg-2">nombre des Chaine Actives</label>
                    <div class="col-lg-10">
                        <input id="nbr_chaine_actif" name="nbr_chaine_actif" type="number" class="form-control" placeholder="Entrer le nombre des chaine actives">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="date_mise_service" class="col-form-label col-lg-2">Date de Mise en Service</label>
                    <div class="col-lg-10">
                        <input id="date_mise_service" name="date_mise_service" type="datetime-local" class="form-control" placeholder="Entrer la date de mise en service">
                    </div>
                </div>
                {{-- <div class="row mb-4">
                    <label for="olt_id" class="col-form-label col-lg-2">OLT</label>
                    <div class="col-lg-10">
                        <select id="olt_id" name="olt_id" class="form-control">
                            <option value="">-- Selectionner un OLT --</option>
                            @foreach ($OLTs as $OLT)
                                <option value={{$OLT->id}}>{{$OLT->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="row mb-4">
                    <label for="installation" class="col-form-label col-lg-2">Installation</label>
                    <div class="col-lg-10">
                        <select id="installation" name="installation" class="form-control">
                            <option value="Aérien">Aérien</option>
                            <option value="Souterrain">Souterrain</option>
                        </select>
                    </div>
                </div>                                   
                <div class="row justify-content-end">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary">Ajouter Hub</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SubBox Modal -->
    <div id="subBoxModal" class="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>SubBox Information</h3>
            <form id="subBoxForm">
                @csrf
                <input type="text" name="type" id="type" class="d-none">
                <div class="row mb-4">
                    <label for="nom" class="col-form-label col-lg-2">Nom</label>
                    <div class="col-lg-10">
                        <input id="nom" name="nom" type="text" class="form-control"
                            placeholder="Entrer le nom">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="num_serie" class="col-form-label col-lg-2">Numero Serie</label>
                    <div class="col-lg-10">
                        <input id="num_serie" name="num_serie" type="text"
                            class="form-control" placeholder="Entrer le numero serie">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="modele" class="col-form-label col-lg-2">Modele</label>
                    <div class="col-lg-10">
                        <input id="modele" name="modele" type="text" class="form-control"
                            placeholder="Entrer le modele">
                    </div>
                </div>
                {{-- <div class="row mb-4">
                    <label for="num_dans_chaine" class="col-form-label col-lg-2">Numero Dans La Chaine</label>
                    <div class="col-lg-10">
                        <input id="num_dans_chaine" name="num_dans_chaine" type="text" class="form-control" placeholder="Entrer le numero dans la chaine">
                    </div>
                </div> --}}
                {{-- <div class="row mb-4">
                    <label for="hub_id" class="col-form-label col-lg-2">Hub</label>
                    <div class="col-lg-10">
                        <select id="hub_id" name="hub_id" class="form-control">
                            <option value="">-- Selectionner Hub --</option>
                            @foreach ($hubs as $hub)
                                <option value="{{ $hub->id }}">{{ $hub->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                {{-- <div class="row mb-4">
                    <label for="sub_box_precedent_id" class="col-form-label col-lg-2">SubBox Precedent</label>
                    <div class="col-lg-10">
                        <select id="sub_box_precedent_id" name="sub_box_precedent_id"
                            class="form-control">
                            <option value="">-- Selectionner SubBox --</option>
                            @foreach ($subBoxs as $subBox)
                                <option value="{{ $subBox->id }}">{{ $subBox->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="row mb-4">
                    <label for="installation"
                        class="col-form-label col-lg-2">Installation</label>
                    <div class="col-lg-10">
                        <select id="installation" name="installation" class="form-control">
                            <option value="Façade">Façade</option>
                            <option value="Poteau">Poteau</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="date_mise_service" class="col-form-label col-lg-2">Date de Mise en Service</label>
                    <div class="col-lg-10">
                        <input id="date_mise_service" name="date_mise_service" type="datetime-local" class="form-control" placeholder="Entrer la date de mise en service">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                    <div class="col-lg-10">
                        <input id="adresse" name="adresse" type="text"
                            class="form-control" placeholder="Entrer l'adresse">
                    </div>
                </div>
                {{-- <div class="row mb-4">
                    <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                    <div class="col-lg-10">
                            @include('Admin/mapDiv')
                    </div>
                </div> --}}
                <div class="row justify-content-end">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary">Ajouter SubBox</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
{{-- olt script --}}
<script>
    function modifyOLT() {
        const newSelectHtml = `
            <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                <select id="carte_id" name="carte_id[]" class="form-control" onchange="checkAndDeleteEmptyOptions(this)">
                    <option value="">-- Sélectionner carte --</option>
                    @foreach ($cartes as $newCarte)
                        <option value="{{ $newCarte->id }}">
                            {{ $newCarte->modele_carte }}
                        </option>
                    @endforeach
                </select>
            </div>
        `;
        document.getElementById('carte_div').insertAdjacentHTML('beforeend', newSelectHtml);
        updateConcatenatedValues();
    }

    function checkAndDeleteEmptyOptions(selectElement) {
        if (selectElement.value === "") {
            selectElement.closest('.col-lg-4').remove();
        }
        updateConcatenatedValues();
    }

    function updateConcatenatedValues() {
        const selectElements = document.querySelectorAll('select[name="carte_id[]"]');
        let values = [];
        selectElements.forEach(select => {
            if (select.value !== "") {
                values.push(select.value);
            }
        });
        const concatenatedValues = values.join(',');
        document.getElementById('concatenated_values').value = concatenatedValues;
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateConcatenatedValues();
    });

    document.querySelectorAll('select[name="carte_id[]"]').forEach(select => {
        select.addEventListener('change', checkAndDeleteEmptyOptions);
    });
</script>
{{-- hub script --}}
<script>
    let ports = [];
    const ports_input = document.getElementById('ports_affecte');

    function add(port) {
        const index = ports.indexOf(port);

        if (index !== -1) {
            ports.splice(index, 1);
            document.getElementById("btn_"+port).classList.remove('btn-success');
            document.getElementById("btn_"+port).classList.add('btn-danger');
        } else {
            ports.push(port);
            document.getElementById("btn_"+port).classList.remove('btn-danger');
            document.getElementById("btn_"+port).classList.add('btn-success');
        }
        ports.sort((a, b) => a - b);
        let value = ports.join(',');
        ports_input.value = value;
    }
</script>
{{-- maprelated scripts --}}
<script>
    let subBoxCount = 0;
    const markers = { OLT: null, Hub: null, SubBoxes: [] };
    const lat = document.getElementById('latitude');
    const lng = document.getElementById('longitude');
    $(document).ready(function(){
        const map = L.map('map').setView([33.858, 10.115], 15); 
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const routingControl = L.Routing.control({
            waypoints: [],
            routeWhileDragging: true,
            showAlternatives: false,
            fitSelectedRoutes: false,
            addWaypoints: false,
            draggableWaypoints: false,
            createMarker: function() { return null; }  
        }).addTo(map);

        function createCustomControl(className, iconHtml, limit) {
            return L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function (map) {
                    this._map = map;
                    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-street-view');
                    this._controlDiv = L.DomUtil.create('div', className + '-control', container);
                    this._controlDiv.innerHTML = `${className} ${iconHtml}`;
                    this._controlDiv.title = `Drag to see ${className} view`;
                    L.DomEvent.disableClickPropagation(container);
                    L.DomEvent.on(this._controlDiv, 'mousedown', this._onDragStart, this);
                    return container;
                },
                _onDragStart: function (e) {
                    if (className == 'SubBox') {
                        if (subBoxCount >= limit) {
                            if (this._controlDiv.classList.contains('disabled')) {
                                return;
                            }
                            this._controlDiv.classList.add('disabled');
                        } else {
                            subBoxCount += 1;
                        }
                    } else {
                        if (this._controlDiv.classList.contains('disabled')) {
                            return;
                        }
                        this._controlDiv.classList.add('disabled');
                    }

                    L.DomEvent.stop(e);
                    if (!this._dragging) {
                        this._dragging = true;
                        this._startPos = this._map.mouseEventToContainerPoint(e);
                        this._marker = L.marker(this._map.getCenter(), {
                            icon: L.divIcon({className: `${className}-marker`, html: iconHtml, iconSize: [25, 41]}),
                            draggable: true,
                            zIndexOffset: 1000
                        }).addTo(this._map);
                        L.DomEvent.on(document, 'mousemove', this._onDrag, this);
                        L.DomEvent.on(document, 'mouseup', this._onDragEnd, this);
                        this._map.on('mousemove', this._onMouseMove, this);
                    }
                },
                _onDrag: function (e) {
                    if (this._dragging) {
                        const pos = this._map.mouseEventToContainerPoint(e);
                        this._marker.setLatLng(this._map.containerPointToLatLng(pos));
                    }
                },
                _onMouseMove: function (e) {
                    if (this._dragging) {
                        this._marker.setLatLng(e.latlng);
                    }
                },
                _onDragEnd: function () {
                    if (this._dragging) {
                        this._dragging = false;
                        L.DomEvent.off(document, 'mousemove', this._onDrag, this);
                        L.DomEvent.off(document, 'mouseup', this._onDragEnd, this);
                        this._map.off('mousemove', this._onMouseMove, this);
                        if (className === 'OLT') markers.OLT = this._marker;
                        else if (className === 'Hub') markers.Hub = this._marker;
                        else if (className === 'SubBox') markers.SubBoxes.push(this._marker);
                        updateRouting();    
                        this._marker.on('dragend', function() {
                            updateRouting();
                        });
                        this._marker.on('click', function(e) {
                            showModal(className, e.latlng);
                        });
                    }
                }
            });
        }

        const OLTControl = createCustomControl('OLT', '<i class="fa-solid fa-server"></i>');
        const HubControl = createCustomControl('Hub', '<i class="fab fa-hubspot equipment-icon"></i>');
        const SubBoxControl = createCustomControl('SubBox', '<i class="fas fa-boxes equipment-icon"></i>', 2);

        L.control.OLT = function (options) { return new OLTControl(options); };
        L.control.Hub = function (options) { return new HubControl(options); };
        L.control.SubBox = function (options) { return new SubBoxControl(options); };

        L.control.OLT().addTo(map);
        L.control.Hub().addTo(map);
        L.control.SubBox().addTo(map);

        function updateRouting() {
            const waypoints = [
                markers.OLT,
                markers.Hub,
                ...markers.SubBoxes
            ].filter(Boolean).map(marker => marker.getLatLng());

            routingControl.setWaypoints(waypoints);
        }

        const oltModal = document.getElementById("oltModal");
        const hubModal = document.getElementById("hubModal");
        const subBoxModal = document.getElementById("subBoxModal");
        const closeBtns = document.getElementsByClassName("close");

        function showModal(type, latlng) {
            let modal;
            if (type === 'OLT') modal = oltModal;
            else if (type === 'Hub') modal = hubModal;
            else if (type === 'SubBox') modal = subBoxModal;

            const latInput = modal.querySelector('input[name="latitude"]');
            const lngInput = modal.querySelector('input[name="longitude"]');
            if (latInput) latInput.value = latlng.lat.toFixed(6);
            if (lngInput) lngInput.value = latlng.lng.toFixed(6);

            const mapContainer = document.getElementById('map');
            modal.style.position = 'absolute';
            modal.style.top = '10px';
            modal.style.right = '10px';
            modal.style.display = 'block';

            if (modal.parentNode !== mapContainer) {
                mapContainer.appendChild(modal);
            }
        };

        Array.from(closeBtns).forEach(btn => {
            btn.onclick = function() {
                oltModal.style.display = "none";
                hubModal.style.display = "none";
                subBoxModal.style.display = "none";
            }
        });

        window.onclick = function(event) {
            if (event.target == oltModal || event.target == hubModal || event.target == subBoxModal) {
                oltModal.style.display = "none";
                hubModal.style.display = "none";
                subBoxModal.style.display = "none";
            }
        };

        document.getElementById('oltForm').onsubmit = function(e) {
            e.preventDefault();
            // Handle OLT form submission
            console.log('OLT form submitted');
        };

        document.getElementById('hubForm').onsubmit = function(e) {
            e.preventDefault();
            // Handle Hub form submission
            console.log('Hub form submitted');
        };

        document.getElementById('subBoxForm').onsubmit = function(e) {
            e.preventDefault();
            // Handle SubBox form submission
            console.log('SubBox form submitted');
        };
    });
</script>
</body>
</html>