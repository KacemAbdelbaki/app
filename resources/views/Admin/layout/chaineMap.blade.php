<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #map {
            height: 400px;
            position: relative;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
        .leaflet-routing-container {
            display: none;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: white;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 100%;
            max-height: 80vh;
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
<body>
    <div id="map"></div>

    <!-- OLT Modal -->
    <div id="oltModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>OLT Information</h3>
            <form id="oltForm">
                <!-- OLT form fields -->
                <div class="form-group">
                    <label for="olt_nom">Nom</label>
                    <input id="olt_nom" name="nom" type="text" class="form-control" placeholder="Entrer le nom">
                </div>
                <div class="form-group">
                    <label for="olt_type">Type</label>
                    <input id="olt_type" name="type" type="text" class="form-control" placeholder="Entrer le type">
                </div>
                <div class="form-group">
                    <label for="olt_modele">Modèle</label>
                    <input id="olt_modele" name="modele" type="text" class="form-control" placeholder="Entrer le modèle">
                </div>
                <!-- Add other OLT fields here -->
                <button type="submit" class="btn btn-primary">Ajouter OLT</button>
            </form>
        </div>
    </div>

    <!-- Hub Modal -->
    <div id="hubModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Hub Information</h3>
            <form id="hubForm">
                <!-- Hub form fields -->
                <div class="form-group">
                    <label for="hub_nom">Nom</label>
                    <input id="hub_nom" name="nom" type="text" class="form-control" placeholder="Entrer le nom">
                </div>
                <div class="form-group">
                    <label for="hub_num_serie">Numero Serie</label>
                    <input id="hub_num_serie" name="num_serie" type="text" class="form-control" placeholder="Entrer le numero serie">
                </div>
                <div class="form-group">
                    <label for="hub_modele">Modèle</label>
                    <input id="hub_modele" name="modele" type="text" class="form-control" placeholder="Entrer le modèle">
                </div>
                <!-- Add other Hub fields here -->
                <button type="submit" class="btn btn-primary">Ajouter Hub</button>
            </form>
        </div>
    </div>

    <!-- SubBox Modal -->
    <div id="subBoxModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>SubBox Information</h3>
            <form id="subBoxForm">
                <!-- SubBox form fields -->
                <div class="form-group">
                    <label for="subbox_nom">Nom</label>
                    <input id="subbox_nom" name="nom" type="text" class="form-control" placeholder="Entrer le nom">
                </div>
                <div class="form-group">
                    <label for="subbox_num_serie">Numero Serie</label>
                    <input id="subbox_num_serie" name="num_serie" type="text" class="form-control" placeholder="Entrer le numero serie">
                </div>
                <div class="form-group">
                    <label for="subbox_modele">Modele</label>
                    <input id="subbox_modele" name="modele" type="text" class="form-control" placeholder="Entrer le modele">
                </div>
                <!-- Add other SubBox fields here -->
                <button type="submit" class="btn btn-primary">Ajouter SubBox</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
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

            // Modal functionality
            const oltModal = document.getElementById("oltModal");
            const hubModal = document.getElementById("hubModal");
            const subBoxModal = document.getElementById("subBoxModal");
            const closeBtns = document.getElementsByClassName("close");

            function showModal(type, latlng) {
                let modal;
                if (type === 'OLT') modal = oltModal;
                else if (type === 'Hub') modal = hubModal;
                else if (type === 'SubBox') modal = subBoxModal;

                // Set latitude and longitude values in the form
                const latInput = modal.querySelector('input[name="latitude"]');
                const lngInput = modal.querySelector('input[name="longitude"]');
                if (latInput) latInput.value = latlng.lat.toFixed(6);
                if (lngInput) lngInput.value = latlng.lng.toFixed(6);

                modal.style.display = "block";
            }

            Array.from(closeBtns).forEach(btn => {
                btn.onclick = function() {
                    oltModal.style.display = "none";
                    hubModal.style.display = "none";
                    subBoxModal.style.display = "none";
                }
            });

            window.onclick = function(event) {
                if (event.target == oltModal<event.target == hubModal || event.target == subBoxModal) {
                    oltModal.style.display = "none";
                    hubModal.style.display = "none";
                    subBoxModal.style.display = "none";
                }
            }

            // Form submission
            document.getElementById('oltForm').onsubmit = function(e) {
                e.preventDefault();
                // Handle OLT form submission
                console.log('OLT form submitted');
            }

            document.getElementById('hubForm').onsubmit = function(e) {
                e.preventDefault();
                // Handle Hub form submission
                console.log('Hub form submitted');
            }

            document.getElementById('subBoxForm').onsubmit = function(e) {
                e.preventDefault();
                // Handle SubBox form submission
                console.log('SubBox form submitted');
            }
        });
    </script>
</body>
</html>