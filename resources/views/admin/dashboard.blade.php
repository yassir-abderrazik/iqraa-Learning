@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <div class="">
                    <h3 class="">Bienvenue {{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>

        <!-- Card de nombre de formations et nombre des etudians -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card text-white bg-success" style="width: 24rem; margin-right: 100px">
                    <div class="card-body">
                        <div style="margin-left: 37%">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-3" width="50px" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3>Nombre des etudiants : {{ $students }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info" style="width: 24rem;">
                    <div class="card-body">
                        <div style="margin-left: 37%">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-3" width="50px" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <h3>Nombre des formations : {{ $course }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success" style="width: 24rem;">
                    <div class="card-body">
                        <div style="margin-left: 37%">
                            <svg xmlns="http://www.w3.org/2000/svg" class="m-3" width="50px" fill="none"
                                class="bi bi-person-fill" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        </div>
                        <h3>Nombre des formateurs : {{ $formateur }} </h3>
                    </div>
                </div>
            </div>
        </div>
        <h3>Dérnier courses :</h3>
        <div class="table-responsive m-3">
            <table class="table table-condensed table-striped table-sm">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Formateur</th>
                        <th>Date de création</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                @foreach ($item->formateurs as $formateur)
                                    {{ $formateur->user->name }}
                                @endforeach
                            </td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
