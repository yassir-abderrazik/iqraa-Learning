@extends('layouts.Formateur')
@section('script')
    <link rel="stylesheet" href=" {{ asset('css/plyr.css') }}" />
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center text-dark">Episodes</h1>
        <form action="{{ route('getEpisodes') }}" method="GET">

            <div class="form-group row">
                <label for="course" class="col-sm-1 col-form-label">Course :</label>
                <div class="col-sm-3">
                    <select class="form-control" id="course" name="course">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary ">Chercher</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-lightblue text-light">
                    <tr>
                        <th>id</th>
                        <th>Course</th>
                        <th>author</th>
                        <th>Episode</th>
                        <th>Contenu</th>
                        <th>Date de création</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody id="dataEp">
                    @foreach ($courses as $course)
                        @foreach ($course->episodes as $index => $episode)
                            <tr>
                                <td>{{ $index + 1 }} </td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $episode->author }}</td>
                                <td>{{ $episode->title }}</td>
                                <td>

                                    @if (pathinfo($episode->path, PATHINFO_EXTENSION) == 'mp4')
                                        <button type="button" class="btn text-primary" data-toggle="modal"
                                            data-target="#path{{ $episode->id }}">
                                            {{ pathinfo($episode->path, PATHINFO_EXTENSION) }}
                                        </button>
                                        <div class="modal fade" id="path{{ $episode->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div id="path-content">
                                                        <video id="player" controls crossorigin playsinline
                                                            class="embed-responsive player embed-responsive-16by9">
                                                            <source id="source"
                                                                src="{{ route('getVideo', ['id' => '', 'path' => $episode->path]) }}"
                                                                type="video/mp4" />
                                                        </video>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a class="btn text-primary"
                                            href="{{ route('getPDF', ['id' => '', 'path' => $episode->path]) }}">{{ pathinfo($episode->path, PATHINFO_EXTENSION) }}</a>
                                    @endif

                                </td>
                                <td>{{ $episode->created_at }}</td>
                                <td>
                                    @if ($episode->author == Auth::user()->name)
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#edit{{ $episode->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <div class="modal fade" id="edit{{ $episode->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $episode->title }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('episodes.update', ['id' => $episode->id]) }}"
                                                        id="form1" enctype="multipart/form-data" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body m-2">

                                                            <div class="form-group row">
                                                                <label for="title">Titre de l'épisode</label>
                                                                <input type="text"
                                                                    class="form-control @error('title') is-invalid @enderror"
                                                                    name="title" id="title"
                                                                    value="{{ old('title', $episode->title ?? null) }}">
                                                                @error('title')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="path">Video/PDF :</label>
                                                                <input type="file"
                                                                    class="custom-file mr-sm-2     @error('path') is-invalid @enderror"
                                                                    name="path"
                                                                    value="{{ old('path', $episode->path ?? null) }}">
                                                                @error('path')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($episode->author == Auth::user()->name)
                                        <form action="{{ route('episodes.delete', ['id' => $episode->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red"
                                                    class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script>
        // function getEpisode() {
        //     var course_id = document.getElementById('course').value;
        //     $.ajax({
        //         url: "/dashboard/formateur/episodes/search",
        //         type: 'GET',
        //         data: {
        //             course_id: course_id
        //         },
        //         dataType: 'json', // added data type
        //         success: function(res) {
        //             var course_id = document.getElementById('dataEp');
        //             course_id.innerHTML = '';
        //             console.log(res);

        //         }
        //     });
        // }

    </script>
@endsection
