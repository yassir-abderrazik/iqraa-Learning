<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('storage/logo.png') }}">

    <title>IQRAA Learning</title>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>

    <nav class="navbar navbar-expand-lg  fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder" href="/">
                <img src="{{ asset('/storage/logo.png') }}" alt="logo" height="80px">
            </a>
            <button class="navbar-toggler text-primary" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-justify"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item dropdown">
                        <a class="nav-link font-weight-bold btn btn-navbar dropdown-toggle text-dark"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">Catégories</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Développement Web']) }}">Développement
                                Web</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Business']) }}">Business</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Finance']) }}">Finance</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Développement mobile']) }}">Développement
                                mobile</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Comptabilité']) }}">Comptabilité</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Big Data']) }}">Big Data</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Design']) }}">Design</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Marketing']) }}">Marketing</a>
                            <a class="dropdown-item borderLeft "
                                href="{{ route('searchCategories', ['category' => 'Photographie']) }}">Photographie</a>
                        </div>
                    </li>
                    <li class="nav-item mr-3">
                        <form action="{{ route('searchCourse') }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Rechercher ..."
                                    aria-label="Recipient's username" name="course">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light">
                                        <button style="background: none;
                                    color: inherit;
                                    border: none;
                                    padding: 0;
                                    font: inherit;
                                    cursor: pointer;
                                    outline: inherit;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#0099FF" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>

                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class=" btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (Auth::user()->type == 'formateur')
                                            <a href="{{ route('formateurdashboard') }}"
                                                class="dropdown-item">Dashboard</a>
                                        @elseif(Auth::user()->type == "admin")
                                            <a href="{{ route('adminDashboard') }}" class="dropdown-item">Dashboard</a>
                                        @else
                                            <a href="{{ route('studentDashboard') }}" class="dropdown-item">Dashboard</a>

                                        @endif
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();"
                                            class=" dropdown-item text-dark">
                                            Se Déconnecter </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>


                            </li>
                        @else
                            <li class="nav-item">

                                <a href="{{ route('login') }}" class="nav-link text-dark  btn mr-2 "
                                    style="border-color: #0099FF;">Se
                                    connecter</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="nav-link btn btn-primary font-weight-bold text-white">Créer un compte</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('header')
    <div class="container-fluid">
        @yield('content')
    </div>

    <div class="container-fluid shadow-lg h-50 d-inline-block mt-3" style="background-color: #dee4ea;">
        <footer style="margin-top: 7%;margin-bottom: 3%;">
            <div class="row">
                <div class="col-md-6 px-5 border-right-dashed">
                    <div class="row">
                        <div class="col-12">
                            {{-- <h1 class="h1  mb-4"> <strong class="text-danger">DOC</strong>MAROC</h1> --}}
                            <img src="{{ asset('/storage/logo.png') }}" alt="logo" class="mt-3" height="100px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-facebook" viewBox="0 0 16 16">
                                <path fill="#0099ff"
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-linkedin" viewBox="0 0 16 16">
                                <path fill="#0274B3"
                                    d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path fill="#55CF62"
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-twitter" viewBox="0 0 16 16">
                                <path fill="#1DA1F2"
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                        </div>


                    </div>

                </div>
                <div class="col-md-3 border-right-dashed">
                    <h6 class="text-center font-weight-bold h2">MENU</h6>
                    <div class="pl-2">
                        <a href="" class="text-dark">Home</a> <br>
                        <a href="" class="text-dark">Cherecher</a> <br>
                        <a href="" class="text-dark">Se connecter</a> <br>
                        <a href="" class="text-dark">Créer un compte</a> <br>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="text-center font-weight-bold h2">ADRESSE</h6>
                    <p>Avenue Mohammed V, 40000 MARTIL, Maroc</p><br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-envelope" viewBox="0 0 16 16">
                        <path
                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                    </svg>
                    <p class="d-inline ">iqraalearning@gmail.com</p>
                </div>
            </div>
        </footer>
    </div>
    {{-- footer contenu FIn --}}
</body>

@yield('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

</html>
