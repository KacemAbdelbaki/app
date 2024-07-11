<!DOCTYPE html>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Include jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include Popper.js (for Bootstrap tooltips and popovers) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                                <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Vous pouvez visualiser ou modifier des informations concernant le materiel AirPon</h4>
                                    <br />

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6 mx-auto">
                                                <ul class="center">
                                                    @foreach ($chaines as $chaine)
                                                        <li>
                                                            <i class="fas fa-server fa-4x" data-toggle="popover" title="{{ $chaine['olt']->nom }}" data-container="body" data-html="true" data-content="{{ '<strong>Nom:</strong> ' . $chaine['olt']->nom . '<br><strong>Coordonnées:</strong> (' . $chaine['olt']->longitude . ', ' . $chaine['olt']->latitude . ')' }}"></i>
                                                            <i class="fas fa-arrow-right fa-2x"></i>
                                                            <i data-toggle="popover" title="{{ $chaine['hub']->nom }}" data-container="body" data-html="true" data-content="{{ '<strong>Nom:</strong> ' . $chaine['hub']->nom }}" class="fab fa-hubspot fa-4x"></i>
                                                            <i class="fas fa-arrow-right fa-2x"></i>
                                                            @foreach ($chaine['subBoxs'] as $subBox)
                                                                <i data-toggle="popover" title="{{ $subBox->nom }}" data-container="body" data-html="true" data-content="{{ '<strong>Nom:</strong> ' . $subBox->nom }}" class="fas fa-box fa-4x"></i>
                                                                <i class="fas fa-arrow-right fa-2x"></i>
                                                            @endforeach
                                                            <i data-toggle="popover" title="{{ $chaine['endBox']->nom }}" data-container="body" data-html="true" data-content="{{ '<strong>Nom:</strong> ' . $chaine['endBox']->nom }}" class="fas fa-stop fa-4x"></i>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                
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
        </div>
    </div>

    <!-- Initialize Popovers -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover({
                trigger: 'hover',
                placement: 'bottom',
                html: true
            });
        });
    </script>

</body>
</html>
