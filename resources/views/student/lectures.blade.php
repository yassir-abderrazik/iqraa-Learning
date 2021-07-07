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


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/student.css') }}" rel="stylesheet">
    <link rel="stylesheet" href=" {{ asset('css/plyr.css') }}" />

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-right bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading bg-lightblue mb-3 text-light text-center">
                <img src="{{ asset('/storage/logowhite.png') }}" alt="logo" height="60px">
            </div>
            <div class="list-group list-group-flush" style="height:85%; overflow-y: scroll;">
                @foreach ($course->episodes as $episode)
                    <li class="list-group-item   ">
                        @if (pathinfo($episode->path, PATHINFO_EXTENSION) == 'mp4')
                            <a type="submit" onclick="getLecture({{ $episode->id }})"
                                class="justify-text d-inline text-lightblue">{{ $episode->title }}</a>
                        @else
                            <a type="submit" onclick="getPDF({{ $episode->id }})"
                                class="text-lightblue">{{ $episode->title }}<small
                                    class="badge badge-danger">pdf</small>
                            </a>
                        @endif
                        @if ($episode->student_count == '0')
                            <div id="episode{{ $episode->id }}">
                                <a type="submit" class="text-dark" onclick="finishedEpisode({{ $episode->id }})"
                                    class="">Términé ?</a>
                            </div>
                        @endif
                    </li>
                @endforeach
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content START-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-navbar-formateur border-bottom">
                <button class="btn btn-primary" id="menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                </button>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                </ul>
            </nav>
            <div class="container-fluid mt-3">
                <div>
                    <h3 class="text-center text-uppercase font-weight-bold"> {{ $course->title }}
                    </h3>
                </div>
                <div class="container-fluid">
                    @if (count($course->students) > 0)
                        <div id="contentEpisode">
                            <img src="{{ asset('/storage/' . $course->picture) }}" alt="" width="100%" height="450px"
                                srcset="">
                        </div>

                    @else
                        <center>
                            <img src="{{ asset('/storage/lock.png') }}" alt="" width="30%" height="20%" srcset="">
                        </center>
                        <h6>Lecture content locked
                            If you're already enrolled, you'll need to login.</h6>
                    @endif
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>
        <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            function getLecture(id) {
                console.log(id);
                var controls = [
                    'play-large', // The large play button in the center
                    'restart', // Restart playback
                    'rewind', // Rewind by the seek time (default 10 seconds)
                    'play', // Play/pause playback
                    'fast-forward', // Fast forward by the seek time (default 10 seconds)
                    'progress', // The progress bar and scrubber for playback and buffering
                    'current-time', // The current time of playback
                    'duration', // The full duration of the media
                    'mute', // Toggle mute
                    'volume', // Volume control
                    'captions', // Toggle captions
                    'settings', // Settings menu
                    'pip', // Picture-in-picture (currently Safari only)
                    'airplay', // Airplay (currently Safari only)
                    'fullscreen', // Toggle fullscreen
                    'quality'
                ];
                var lecture = document.getElementById('contentEpisode');
                lecture.innerHTML = '';
                lecture.innerHTML = `
                <video id="player" controls crossorigin playsinline
                                                            class="embed-responsive player embed-responsive-16by9">
                                                            <source id="source"
                                                                src="/dashboard/student/episodes/video/` + id + `"
                                                                type="video/mp4" />
                                                        </video>
                        `

                const player = new Plyr("#player", {
                    controls,
                });
            }

            function getPDF(id) {
                console.log(id);

                var lecture = document.getElementById('contentEpisode');
                lecture.innerHTML = '';
                lecture.innerHTML = `
                <embed src="/dashboard/student/download/pdf/` + id + `" width="100%" height="600px" 
                        type="application/pdf">
                        `


            }

            function finishedEpisode(id) {
                $.ajax({
                    url: "/dashboard/student/episodes/finished/" + id,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        var episode = document.getElementById('episode' + id);
                        episode.innerHTML = '';
                    }
                });
            }
        </script>
</body>

</html>
