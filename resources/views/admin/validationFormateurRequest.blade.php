@extends('layouts.admin')
@section('content')
    <h1 class="text-center text-dark">Demandes</h1>
    <table class="table">
        <thead class="bg-lightblue text-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Compétences</th>
                <th scope="col">validation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $index => $request)
                <tr>
                    <th>{{ $index + 1 }}</th>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#request{{ $request->id }}">
                            fichier</button>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            id="request{{ $request->id }}" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <embed src="{{ asset('/storage/' . $request->file) }}" type="application/pdf"
                                        height="600px">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('validateFormateurRequest', $request->id) }}" method="POST"
                            class="d-inline">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="validation" value="1">
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-check-square-fill" viewBox="0 0 16 16">
                                    <path fill="green"
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('validateFormateurRequest', $request->id) }}" method="POST"
                            class="d-inline">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="validation" value="0">
                            <button type="submit" class="btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                    <path fill="red"
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
