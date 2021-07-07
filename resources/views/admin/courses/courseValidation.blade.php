@extends('layouts.admin')
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
@endsection
