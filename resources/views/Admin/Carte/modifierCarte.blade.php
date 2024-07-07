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
                                <h4 class="mb-sm-0 font-size-18">Ajouter Nouveau</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Ajouter Nouvelle Carte</h4>
                                    <form action="{{ route('carte.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="row mb-4">
                                            <label for="modele_carte" class="col-form-label col-lg-2">modele de la carte</label>
                                            <div class="col-lg-10">
                                                <input id="modele_carte" name="modele_carte" type="text" value="{{ $data->modele_carte }}" class="form-control" placeholder="Entrer le modele de la carte">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="num_ports" class="col-form-label col-lg-2">Numero ports</label>
                                            <div class="col-lg-10">
                                                <input id="num_ports" name="num_ports" type="number" value="{{ $data->num_ports }}" class="form-control" placeholder="Entrer le numero des ports">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Ajouter Carte</button>
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