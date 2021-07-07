<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    {{-- <script src="{{ asset('js/moment.min.js') }}"></script> --}}
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/formateur.css') }}" rel="stylesheet">

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-sidebar-formateur border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <img src="{{ asset('/storage/logowhite.png') }}" alt="logo" height="60px">
            </div>
            <div class="list-group list-group-flush ">
                <a href="{{ route('formateurdashboard') }}"
                    class="list-group-item list-group-item-action bg-sidebar-formateur">Dashboard</a>
                <div class="dropdown">
                    <a href="" class=" list-group-item list-group-item-action bg-sidebar-formateur dropdown-toggle"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Formations</a>
                    <div class="dropdown-list" id="dropdown-list" aria-labelledby="dropdownMenuButton">
                        <a class="list-group-item list-group-item-action pl-5 bg-sidebar-formateur"
                            href="{{ route('courses.create') }}">Ajouter</a>
                        <a class="list-group-item list-group-item-action pl-5 bg-sidebar-formateur"
                            href="{{ route('courses.edit') }}">Afficher/Modifier</a>

                    </div>
                </div>
                <div class="dropdown">
                    <a href="" class=" list-group-item list-group-item-action bg-sidebar-formateur dropdown-toggle"
                        id="episodes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Episodes</a>
                    <div class="dropdown-list" id="dropdown-list" aria-labelledby="episodes">
                        <a class="list-group-item list-group-item-action pl-5 bg-sidebar-formateur"
                            href="{{ route('episodes.create') }}">Ajouter</a>
                        <a class="list-group-item list-group-item-action pl-5 bg-sidebar-formateur"
                            href="{{ route('episodes.edit') }}">Afficher/Modifier</a>
                    </div>
                </div>
                <a href="{{ route('statistics') }}"
                    class="list-group-item list-group-item-action bg-sidebar-formateur">Statistiques</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content START-->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-navbar-formateur border-bottom">
                <button class="btn btn-primary" id="menu-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                </button>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link text-dark">
                        Se Déconnecter </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>

            <div class="container-fluid mt-3">
                @yield('content')
            </div>
        </div>
        <!-- Page Content END -->

    </div>
    <!-- /#wrapper -->

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        var dropdown = document.getElementById("dropdownMenuButton");
        dropdown.addEventListener('click', function() {
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }

        });
        var dropdown = document.getElementById("episodes");
        dropdown.addEventListener('click', function() {
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }

        });
    </script>

</body>

</html>
