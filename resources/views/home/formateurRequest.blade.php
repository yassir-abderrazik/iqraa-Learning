@extends('layouts.welcome')
@section('content')
    <div class="container-fluid  h-100 margin-top ">
        <div class="align-items-center bg-white p-4">
            <div class="card text-center mt-4">
                <div class="card-header bg-lightblue">
                    <div class="mt-3">
                        <h2 class="card-title  text-light">Devenir un Formateur !</h2>
                    </div>
                </div>
                <div class="card-body m-2">
                    <div class="vertical-center ">
                        <div class="container">
                            <div class="row justify-content-center ">
                                <div class="col-md-6">
                                    <div class="login-card shadow pt-2">
                                        <div class="text-center m-3">
                                            <h1 class="font-weight-bold">Envoyer votre demande </h1>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('formateurRequestAdd') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nom
                                                        :</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}" required
                                                            autocomplete="name" autofocus>

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">Adresse
                                                        mail :</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="file" class="col-md-4 col-form-label text-md-right">Vos
                                                        compétences
                                                        :</label>

                                                    <div class="col-md-6">
                                                        <input id="file" type="file"
                                                            class="form-control-file @error('file') is-invalid @enderror"
                                                            name="file" value="{{ old('file') }}" required
                                                            autocomplete="file">
                                                        <small class="text-danger">fichier ne peut pas dépasser 3 mb</small>
                                                        @error('file')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <p class="text-left">
                                                <div class=" text-danger d-inline">NB:</div> Une fois votre demande est
                                                traitée,
                                                vous allez
                                                recevoir un courrier électronique dans votre boîte e-mail.
                                                </p>
                                                <div class="form-group mb-0">
                                                    <center>
                                                        <button type="submit" class="btn bg-lightblue text-white">
                                                            Envoyer
                                                        </button>
                                                    </center>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
