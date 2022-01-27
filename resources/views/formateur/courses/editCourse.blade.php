@extends('layouts.Formateur')
@section('script')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

@endsection
@section('content')
    <h1 class="text-center text-dark">Mes formations</h1>
    <table class="table">
        <thead class="bg-lightblue text-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Titre</th>
                <th scope="col">Niveau</th>
                <th scope="col">Type</th>
                <th scope="col">Prix ($)</th>
                <th scope="col">Dureé</th>
                <th scope="col">Image</th>
                <th scope="col">Validation</th>
                <th scope="col">Modifier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $allCourses)
                @foreach ($allCourses->courses as $index => $course)
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
                        <td>{{ $course->validation }}</td>
                        <td>
                            <button class="btn  btn-warning" data-toggle="modal"
                                data-target="#editcourse{{ $course->id }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            <div class="modal fade" id="editcourse{{ $course->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Formation :
                                                {{ $course->title }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('courses.update', ['id' => $course->id]) }}" method="POST"
                                            id="form1" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body m-2">
                                                <div class="form-group row">
                                                    <label for="title">Titre de la formation</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        name="title" id="title"
                                                        value="{{ old('title', $course->title ?? null) }}">
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <textarea
                                                        class="summernote form-control @error('description') is-invalid @enderror"
                                                        name="description"
                                                        id="description">{{ old('description', $course->description ?? null) }}</textarea>

                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="level">Niveau de la formation </label>
                                                        <select class="form-control" id="level" name="level">
                                                            <option value="{{ old('level', $course->level ?? null) }}">
                                                                {{ old('level', $course->level ?? null) }}</option>
                                                            <option value="Débutant">Débutant</option>
                                                            <option value="Intermédiaire">Intermédiaire</option>
                                                            <option value="Avancé">Avancé</option>
                                                        </select>
                                                        @error('level')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="price">Prix de la formation $</label>
                                                        <input type="number"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            name="price" id="price" min="1"
                                                            value="{{ old('price', $course->price ?? null) }}">
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="hours">Durée de la formation (H) </label>
                                                        <input type="number"
                                                            class="form-control @error('hours') is-invalid @enderror"
                                                            name="hours" id="hours" min="1"
                                                            value="{{ old('hours', $course->hours ?? null) }}">
                                                        @error('hours')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="type">Type</label>
                                                        <select class="form-control" id="type" name="type">
                                                            <option value="{{ old('type', $course->type ?? null) }}">
                                                                {{ old('type', $course->type ?? null) }}</option>
                                                            <option value="Développement web">Développement web</option>
                                                            <option value="Intermédiaire">Intermédiaire</option>
                                                            <option value="Avancé">Avancé</option>
                                                        </select>
                                                        @error('type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class=" row">
                                                    <div class="col-md-6">
                                                        <label for="picture">Image </label>
                                                        <input type="file"
                                                            class="custom-file mr-sm-2     @error('picture') is-invalid @enderror"
                                                            name="picture" id="picture" accept=".jpg, .jpeg, .png"
                                                            value="{{ old('picture', $course->picture ?? null) }}">
                                                        @error('picture')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 100, // set editor height
                width: 950,
                focus: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });
        $('#form1').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
