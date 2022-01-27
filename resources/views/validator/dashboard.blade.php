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
    <script src="{{ asset('js/moment.min.js') }}"></script>
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#"> <img src="{{ asset('/storage/logo.png') }}" alt="logo"
                        height="60px"></a>

                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link text-dark">
                        Se Déconnecter </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </nav>

        <h1 class="text-center text-dark">Courses</h1>
        <table class="table">
            <thead style=" background-color: #0099FF;" class="text-light">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Type</th>
                    <th scope="col">Prix ($)</th>
                    <th scope="col">Dureé</th>
                    <th scope="col">Image</th>
                    <th scope="col">Formateurs</th>
                    <th scope="col">Validé</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $index => $course)
                    <tr>
                        <th>{{ $index + 1 }}</th>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->level }}</td>
                        <td>{{ $course->type }}</td>
                        <td>{{ $course->price }}</td>
                        <td>{{ $course->hours }} H</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#image{{ $course->id }}">
                                afficher
                            </button>
                            <div class="modal fade" id="image{{ $course->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <img src="{{ asset('/storage/' . $course->picture) }}" alt="" srcset="">
                                    </div>

                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach ($course->formateurs as $formateur)
                                <span class="badge badge-light"> {{ $formateur->user->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('validateCourse', $course->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                        <path fill="green"
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('sweetalert::alert')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>
