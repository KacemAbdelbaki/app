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
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Modifier</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Modifier Hub</h4>
                                    <form action="{{ route('hub.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="row mb-4">
                                            <label for="nom" class="col-form-label col-lg-2">Nom</label>
                                            <div class="col-lg-10">
                                                <input id="nom" name="nom" type="text" value="{{ $data->nom }}" class="form-control" placeholder="Entrer le nom">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="num_serie" class="col-form-label col-lg-2">Numero Serie</label>
                                            <div class="col-lg-10">
                                                <input id="num_serie" name="num_serie" value="{{ $data->num_serie }}" type="text" class="form-control" placeholder="Entrer le numero serie">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="modele" class="col-form-label col-lg-2">Modèle</label>
                                            <div class="col-lg-10">
                                                <input id="modele" name="modele" value="{{ $data->modele }}" type="text" class="form-control" placeholder="Entrer le modèle">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="ports_affecte" class="col-form-label col-lg-2">Ports Affectes</label>
                                            <div class="col-lg-10">
                                                <input id="ports_affecte" name="ports_affecte" value="{{ $data->ports_affecte }}" type="text" class="form-control" placeholder="Entrer les ports affectes">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="adresse" class="col-form-label col-lg-2">Adresse</label>
                                            <div class="col-lg-10">
                                                <input id="adresse" name="adresse" value="{{ $data->adresse }}" type="text" class="form-control" placeholder="Entrer l'adresse'">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="longitude" class="col-form-label col-lg-2">Coordonnées</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2 mb-md-0">
                                                        <input id="longitude" name="longitude" value="{{ $data->longitude }}" type="float" class="form-control" placeholder="Longitude">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="latitude" name="latitude" value="{{ $data->latitude }}" type="float" class="form-control" placeholder="Latitude">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="nbr_chaine_actif" class="col-form-label col-lg-2">nombre des Chaine Actives</label>
                                            <div class="col-lg-10">
                                                <input id="nbr_chaine_actif" name="nbr_chaine_actif" value="{{ $data->nbr_chaine_actif }}" type="number" class="form-control" placeholder="Entrer le nombre des chaine actives">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="date_mise_service" class="col-form-label col-lg-2">Date de Mise en Service</label>
                                            <div class="col-lg-10">
                                                <input id="date_mise_service" name="date_mise_service" value="{{ $data->date_mise_service }}" type="datetime-local" class="form-control" placeholder="Entrer la date de mise en service">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="sub_box_id" class="col-form-label col-lg-2">SubBox</label>
                                            <div class="col-lg-10">
                                                <select id="sub_box_id" name="sub_box_id" value="{{ $data->sub_box_id }}" class="form-control">
                                                    @foreach ($subBoxs as $subBox)
                                                        <option value={{$subBox->id}}>{{$subBox->nom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>      
                                        <div class="row mb-4">
                                            <label for="installation" class="col-form-label col-lg-2">Installation</label>
                                            <div class="col-lg-10">
                                                <select id="installation" name="installation" value="{{ $data->installation }}" class="form-control">
                                                        <option value="Aérien">Aérien</option>
                                                        <option value="Sousterrain">Sousterrain</option>
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
                        </div>
                    </div>
                </div> 
            </div>

            @include('Admin/layout/footer')
</body>
</html>