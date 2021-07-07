@extends('layouts.Formateur')
@section('script')
    <link rel="stylesheet" href=" {{ asset('css/plyr.css') }}" />

@endsection

@section('content')
    <h1 class="text-center">Ajouter épisode</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-body">
                    <form action="{{ route('episodes.store') }}" method="POST" id="form1" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="course">Formation</label>
                            <select class="form-control" id="course" name="course">
                                <option value="{{ old('formation', $course->course ?? null) }}">
                                    {{ old('formation', $course->course ?? null) }}</option>
                                @foreach ($courses as $allCourses)
                                    @foreach ($allCourses->courses as $index => $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="title">Titre de l'épisode</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" value="{{ old('title', $episode->title ?? null) }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="path">Video/PDF :</label>
                            <input type="file" class="custom-file mr-sm-2     @error('path') is-invalid @enderror"
                                name="path" value="{{ old('path', $episode->path ?? null) }}">
                            @error('path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="container">
                            <div id="file">
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn mt-2 btn-primary btn-lg">Ajouter l'épisode</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">


    </div>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>

    <script>
        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var extension = this.files[0].type;

                    console.log(extension);
                    var fileuploaded = document.getElementById('file');

                    const source = URL.createObjectURL(this.files[0]); // set src to file url
                    if (extension == "video/mp4") {
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
                            'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
                            'fullscreen', // Toggle fullscreen
                            'quality'
                        ];
                        fileuploaded.innerHTML = `<video id="player" controls crossorigin playsinline 
                                                                                                class="embed-responsive player embed-responsive-16by9">
                                                                                                <source id="source" src="" type="video/mp4"  />
                                                                                            </video>`
                        const player = new Plyr("#player", {
                            controls,
                        });

                        var vid = document.getElementById('source');
                        vid.src = source;
                    } else if (extension == "application/pdf") {
                        fileuploaded.innerHTML =
                            `<embed src="" width="100%" height="400px"
                                                            type = "application/pdf" id="pdf" > `
                        var pdf = document.getElementById('pdf');
                        pdf.src = source;
                    } else {
                        fileuploaded.innerHTML =
                            '<p class="text-danger">Le champ  doit être un fichier de type : MP4 ou PDF </p>'
                    }
                }
            });
        });
    </script>

@endsection
