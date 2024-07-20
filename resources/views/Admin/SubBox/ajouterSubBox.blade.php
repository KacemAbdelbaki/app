<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Espace Administrateur Cartes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href=" {{ asset('images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href=" {{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href=" {{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href=" {{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">

        <!-- Left Sidebar/Navbar Start -->
        @include('Admin/layout/navbar')
        @include('Admin/layout/sidebar')
        <!-- Left Sidebar/Navbar End -->

        <!-- Start right Content here -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center">
                                <h4 class="mb-sm-0 font-size-18">Ajouter Nouveau </h4>
                                <ul class="nav nav-tabs ms-3">
                                    <li class="nav-item">
                                        <a id="SubBox" name="SubBox" class="nav-link active"aria-current="page">SubBox</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="EndBox" name="EndBox" class="nav-link" aria-current="page">EndBox</a>
                                    </li>
                                </ul>
                            </div>

                            {{-- <div class="card mb-4">
                                <div class="card-header d-flex align-items-center">
                                    <h4 class="card-title mb-0">Ajouter Nouveau</h4>
                                    <ul class="nav nav-tabs ms-3">
                                        <li class="nav-item">
                                            <a id="SubBox" name="SubBox" class="nav-link active" aria-current="page">SubBox</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="EndBox" name="EndBox" class="nav-link" aria-current="page">EndBox</a>
                                        </li>
                                    </ul>
                                    <input type="text" name="type" id="type" class="d-none">
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card mb-4">
                                        <div class="card-header d-flex align-items-center">
                                            @php
                                                $Box = "";
                                            @endphp
                                            <h4 id="Box" class="card-title mb-0">Ajouter Nouveau </h4>
                                        </div>
                                    </div>
                                    <form action="{{ route('subBox.store') }}" method="POST">
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
                                        <div class="row mb-4">
                                            <label for="hub_id" class="col-form-label col-lg-2">Hub</label>
                                            <div class="col-lg-10">
                                                <select id="hub_id" name="hub_id" class="form-control">
                                                    <option value="">-- Selectionner Hub --</option>
                                                    @foreach ($hubs as $hub)
                                                        <option value="{{ $hub->id }}">{{ $hub->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="sub_box_precedent_id" class="col-form-label col-lg-2">SubBox
                                                Precedent</label>
                                            <div class="col-lg-10">
                                                <select id="sub_box_precedent_id" name="sub_box_precedent_id"
                                                    class="form-control">
                                                    <option value="">-- Selectionner SubBox --</option>
                                                    @foreach ($subBoxs as $subBox)
                                                        <option value="{{ $subBox->id }}">{{ $subBox->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                            <label for="date_mise_service" class="col-form-label col-lg-2">Date de
                                                Mise en
                                                Service</label>
                                            <div class="col-lg-10">
                                                <input id="date_mise_service" name="date_mise_service"
                                                    type="datetime-local" class="form-control"
                                                    placeholder="Entrer la date de mise en service">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                                            <div class="col-lg-10">
                                                <input id="adresse" name="adresse" type="text"
                                                    class="form-control" placeholder="Entrer l'adresse">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2 mb-md-0">
                                                        <input id="longitude" name="longitude" type="float"
                                                            class="form-control" placeholder="Longitude">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="latitude" name="latitude" type="float"
                                                            class="form-control" placeholder="Latitude">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Ajouter SubBox</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const type = document.getElementById('type');
        const SubBox = document.getElementById('SubBox');
        const EndBox = document.getElementById('EndBox');
        const hub = document.getElementById('hub_id');
        const Box = document.getElementById('Box');
        const subBoxPrecedent = document.getElementById('sub_box_precedent_id');

        if (SubBox.classList.contains('active')) {
            type.value = 'SubBox';
            Box.textContent = 'Ajouter Nouveau SubBox';
        } else {
            type.value = 'EndBox';
            Box.textContent = 'Ajouter Nouveau EndBox';
        }

        SubBox.addEventListener('click', function() {
            SubBox.classList.add('active');
            EndBox.classList.remove('active');
            type.value = 'SubBox';
            hub.disabled = false;
            subBoxPrecedent.disabled = false;
            Box.textContent = 'Ajouter Nouveau SubBox';
        });

        EndBox.addEventListener('click', function() {
            EndBox.classList.add('active');
            SubBox.classList.remove('active');
            type.value = 'EndBox';
            hub.disabled = true;
            subBoxPrecedent.disabled = true;
            Box.textContent = 'Ajouter Nouveau EndBox';
        });

        hub.addEventListener('change', function() {
            if (hub.value !== "") {
                subBoxPrecedent.disabled = true;
            } else {
                subBoxPrecedent.disabled = false;
            }
        });

        subBoxPrecedent.addEventListener('change', function() {
            if (subBoxPrecedent.value !== "") {
                hub.disabled = true;
            } else {
                hub.disabled = false;
            }
        });
    });
</script>

</html>
