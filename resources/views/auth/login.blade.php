@extends('layouts.login')

@section('content')

    <div class="vertical-center ">
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-md-6 ">
                    <div class="login-card shadow">
                        <center>
                            <img src="{{ asset('/storage/login-logo.png') }}" width="160px" alt="">
                        </center>
                        <div class="text-center m-3">
                            <h1 class="font-weight-bold">Se connecter</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email :</label>

                                    <div class="col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white" id="basic-addon1"><svg
                                                    xmlns="{{ asset('/storage/person-fill.svg') }}" width="16" height="16"
                                                    fill="#0099ff" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                </svg></span>

                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe
                                        :</label>

                                    <div class="col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white" id="basic-addon1"><svg
                                                    xmlns="{{ asset('/storage/key-fill.svg') }}" width="16" height="16"
                                                    fill="#0099ff" class="bi bi-key-fill" viewBox="0 0 16 16">
                                                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>

                                                </svg></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group  mb-0 mt-4">
                                    <center>
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                           se connecter
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
@endsection
