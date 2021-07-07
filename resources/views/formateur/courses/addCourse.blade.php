@extends('layouts.Formateur')

@section('script')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" id="form1" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title">Titre de la formation</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" value="{{ old('title', $course->title ?? null) }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <textarea class="summernote form-control @error('description') is-invalid @enderror"
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
                                <label for="price">Prix de la formation </label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                    id="price" min="1" value="{{ old('price', $course->price ?? null) }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="hours">Durée de la formation </label>
                                <input type="number" class="form-control @error('hours') is-invalid @enderror" name="hours"
                                    id="hours" min="1" value="{{ old('hours', $course->hours ?? null) }}">
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
                                    <option value="Développement Web">Développement Web</option>
                                    <option value="Business">Business</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Développement mobile">Développement mobile</option>
                                    <option value="Comptabilité">Comptabilité</option>
                                    <option value="Big Data">Big Data</option>
                                    <option value="Design">Design</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Photographie">Photographie</option>
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
                                <label for="tags">Tags </label>
                                <input type="text" data-role="tagsinput" name="tags"
                                    class="form-control tags @error('tags') is-invalid @enderror"
                                    value="{{ old('tags', $course->tags ?? null) }}">
                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="picture">Image </label>
                                <input type="file" class="custom-file mr-sm-2     @error('picture') is-invalid @enderror"
                                    name="picture" id="picture" accept=".jpg, .jpeg, .png"
                                    value="{{ old('picture', $course->picture ?? null) }}">
                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="formateurs">Autres formateurs</label>
                                <select class="form-control" id="formateurs" name="formateurs">
                                    <option value=""></option>
                                    @foreach ($formateurs as $formateur)
                                        <option value="{{ $formateur->formateur->id }}">
                                            {{ 'Nom : ' . $formateur->name . '  | Email : ' . $formateur->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('formateurs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn mt-2 btn-primary btn-lg">Créer ma formation</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
