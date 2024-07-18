<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Espace Administrateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <!-- ========== Navbar Start ========== -->
        @include('Admin/layout/navbar')
        <!-- Navbar End -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('Admin/layout/sidebar')
        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Liste des Hubs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Vous pouvez supprimer ou modifier des informations concernant les Hubs</h4>
                                    <br />
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Modèle</th>
                                                <th>Numero Serie</th>
                                                <th>Installation</th>
                                                <th>Ports Affectés</th>
                                                <th>Adresse</th>
                                                <th>Nombre Des Chaine Actif</th>
                                                <th>OLT</th>
                                                <th>SubBox</th>
                                                <th>Date Mise En Service</th>
                                                <th>Coordonne</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td style="vertical-align: middle;">{{ $item->nom }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->modele }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->num_serie }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->installation }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->ports_affecte }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->adresse }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->nbr_chaine_actif }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->olt->nom }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->subBox->nom ?? "---"}}</td>
                                                    <td style="vertical-align: middle;">{{ $item->date_mise_service }}</td>
                                                    <td style="vertical-align: middle;">{{ $item->latitude }} {{ $item->longitude }}</td>
                                                    <td>
                                                        <a href="{{ route('modifierHub', ['id' => $item->id]) }}"
                                                            class="btn btn-primary">Modifier</a>
                                                        <a href="{{ route('supprimerHub', ['id' => $item->id]) }}"
                                                            class="btn btn-danger">Supprimer </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->



                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <!-- ========== Footer Start ========== -->
            @include('Admin/layout/footer')
            <!-- Footer End -->
</body>

</html>
