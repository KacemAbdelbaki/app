<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Espace Administrateur Cartes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('Admin/layout/navbar')
        @include('Admin/layout/sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Modifier</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Modifier OLT</h4>
                                    <form action="{{ route('olt.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                        <div class="row mb-4">
                                            <label for="nom" class="col-form-label col-lg-2">Nom</label>
                                            <div class="col-lg-10">
                                                <input id="nom" name="nom" value="{{ $data->nom }}" type="text" class="form-control" placeholder="Entrer le nom">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="type" class="col-form-label col-lg-2">Type</label>
                                            <div class="col-lg-10">
                                                <input id="type" name="type" value="{{ $data->type }}" type="text" class="form-control" placeholder="Entrer le type">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="modele" class="col-form-label col-lg-2">Modèle</label>
                                            <div class="col-lg-10">
                                                <input id="modele" name="modele" type="text" value="{{ $data->modele }}" class="form-control" placeholder="Entrer le modèle">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2 mb-md-0">
                                                        <input id="longitude" name="longitude" type="float" value="{{ $data->longitude }}" class="form-control" placeholder="Longitude">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="latitude" name="latitude" type="float" value="{{ $data->latitude }}" class="form-control" placeholder="Latitude">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                                            <div class="col-lg-10">
                                                <input id="adresse" name="adresse" type="text" value="{{ $data->adresse }}" class="form-control" placeholder="Entrer l'adresse">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="centrale_optique" class="col-form-label col-lg-2">Centrale Optique</label>
                                            <div class="col-lg-10">
                                                <input id="centrale_optique" name="centrale_optique" type="text" value="{{ $data->centrale_optique }}" class="form-control" placeholder="Entrer la centrale optique">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="numero_slot_board" class="col-form-label col-lg-2">Numéro de Slot Board</label>
                                            <div class="col-lg-10">
                                                <input id="numero_slot_board" name="numero_slot_board" type="number" value="{{ $data->numero_slot_board }}" class="form-control" placeholder="Entrer le numéro de slot board">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="capacite_en_port" class="col-form-label col-lg-2">Capacite En Port</label>
                                            <div class="col-lg-10">
                                                <input id="capacite_en_port" name="capacite_en_port" type="text" value="{{ $data->capacite_en_port }}" class="form-control" placeholder="Entrer le numéro de slot board">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="date_mise_service" class="col-form-label col-lg-2">Date de Mise en Service</label>
                                            <div class="col-lg-10">
                                                <input id="date_mise_service" name="date_mise_service" value="{{ $data->date_mise_service }}" type="datetime-local" class="form-control" placeholder="Entrer la date de mise en service">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="carte_id" class="col-form-label col-lg-2 d-flex align-items-center">
                                                Carte 
                                                <button type="button" class="btn btn-primary btn-sm ms-2" onclick="modifyOLT()">+</button>
                                            </label>
                                            <div class="col-lg-10">
                                                <div id="carte_div" class="row">
                                                    @foreach ($data->cartes as $index => $carte)
                                                        <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                                                            <select id="carte_id_{{ $index }}" name="carte_id[]" class="form-control" onchange="checkAndDeleteEmptyOptions(this)">
                                                                <option value="">-- Sélectionner carte --</option>
                                                                @foreach ($newCartes as $newCarte)
                                                                    <option value="{{ $newCarte->id }}" {{ $carte->id == $newCarte->id ? 'selected' : '' }}>
                                                                        {{ $newCarte->modele_carte }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="concatenated_values" name="concatenated_values" value="">
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Modifier OLT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            @include('Admin/layout/footer')
</body>

<script>
    function modifyOLT() {
        const newSelectHtml = `
            <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                <select id="carte_id" name="carte_id[]" class="form-control" onchange="checkAndDeleteEmptyOptions(this)">
                    <option value="">-- Sélectionner carte --</option>
                    @foreach ($newCartes as $newCarte)
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

</html>
