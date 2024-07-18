<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-components">Outils</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-user-friends" style='font-size:14px'></i>
                        <span key="t-ui-elements">OLT</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('olts')}}" key="t-buttons">Liste des OLTs</a></li>
                        <li><a href="{{route('ajouterOLT')}}" key="t-alerts">Ajouter un OLT</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users" style='font-size:14px'></i>
                        <span key="t-ui-elements">Carte</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('cartes')}}" key="t-buttons">Liste des Cartes</a></li>
                        <li><a href="{{route('ajouterCarte')}}" key="t-alerts">Ajouter une Carte</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users" style='font-size:14px'></i>
                        <span key="t-ui-elements">Hub</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('hubs')}}" key="t-alerts">Liste des Hub</a></li>
                        <li><a href="{{route('ajouterHub')}}" key="t-buttons">Ajouter un Hubs</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users" style='font-size:14px'></i>
                        <span key="t-ui-elements">SubBox</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('subBoxs')}}" key="t-alerts">Liste des SubBox</a></li>
                        <li><a href="{{route('ajouterSubBox')}}" key="t-buttons">Ajouter un SubBoxs</a></li>
                    </ul>
                </li>
                
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>


<!-- JAVASCRIPT -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js (required for Bootstrap tooltips and popovers) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <!-- Bootstrap JS (using CDN for better performance) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- MetisMenu -->
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <!-- SimpleBar -->
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <!-- ApexCharts (if you're using charts) -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Custom Scripts -->
    <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>