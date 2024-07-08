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
                        <li><a href="{{route('hubs')}}" key="t-alerts">Ajouter un Hub</a></li>
                        <li><a href="{{route('ajouterHub')}}" key="t-buttons">Liste des Hubs</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users" style='font-size:14px'></i>
                        <span key="t-ui-elements">SubBox</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('subBoxs')}}" key="t-alerts">Ajouter un SubBox</a></li>
                        <li><a href="{{route('ajouterSubBox')}}" key="t-buttons">Liste des SubBoxs</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users" style='font-size:14px'></i>
                        <span key="t-ui-elements">EndBox</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('endBoxs')}}" key="t-alerts">Ajouter un EndBox</a></li>
                        <li><a href="{{route('ajouterEndBox')}}" key="t-buttons">Liste des EndBoxs</a></li>
                    </ul>
                </li>

                
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>


<!-- JAVASCRIPT -->
<script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.js') }}"></script>