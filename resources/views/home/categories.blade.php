@extends('layouts.welcome')

@section('content')
    <div class="container-fluid  h-100 margin-top ">
        <div class="align-items-center bg-white p-4">
            <div class="row">
                <div class="col-md-8 mt-3">
                    <h3 class="bg-lightblue text-light p-2 w-100" style="border-radius: 20px">Catégorie :
                        {{ Request::segment(2) }}</h3>
                    <div class="mt-2">
                        @foreach ($courses as $course)
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <img src="{{ asset('/storage/' . $course->picture) }}" width="100%" height="200px"
                                        style="border-radius: 20px">
                                </div>
                                <div class="col-md-8">
                                    <a href="{{ route('course.details', ['slug' => $course->slug]) }}" class="">
                                        <h2 class="text-dark font-weight-bold mt-2">{{ $course->title }}</h2>
                                    </a>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                            </svg>
                                            <p class=" d-inline">{{ $course->created_at->isoFormat('MMMM D , Y') }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            Difficulté :{{ $course->level }}
                                        </div>
                                        <div class="col-md-4">
                                            Durée : {{ $course->hours }}H
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class=" d-inline"> <strong>Tags :</strong></p>
                                        @foreach ($course->tags as $tag)
                                            <a href="{{ route('searchWithTag', ['id' => $tag->id]) }}"
                                                class="bg-lightblue py-1 px-2 text-light d-inline"
                                                style="border-radius: 20px">
                                                {{ $tag->tag }}</a>
                                        @endforeach
                                    </div>
                                    <div class="mt-2">
                                        <p class=" d-inline"> <strong> Foramteur (s) : </strong></p>
                                        @foreach ($course->formateurs as $formateurs)
                                            <a href="{{ route('searchWithAuthor', ['id' => $formateurs->id]) }}"
                                                class=" py-1 px-2 text-dark d-inline">
                                                {{ $formateurs->user->name }}</a>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('course.details', ['slug' => $course->slug]) }}"
                                            class="btn btn-primary" style="border-radius: 20px">Acheter <strong>
                                                {{ $course->price }}$</strong></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $courses->links() }}
                    </div>
                </div>
                <div class="col-md-4 mt-4 py-3">

                    <h3 class="text-lightblue  p-1 ">Catégories</h3>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Développement Web']) }}">Développement Web</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Business']) }}">Business</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Finance']) }}">Finance</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Développement mobile']) }}">Développement
                        mobile</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Comptabilité']) }}">Comptabilité</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Big Data']) }}">Big
                        Data</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Design']) }}">Design</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Marketing']) }}">Marketing</a>
                    <a class="dropdown-item  border-radius-20"
                        href="{{ route('searchCategories', ['category' => 'Photographie']) }}">Photographie</a>
                    {{-- <h3 class="text-lightblue  p-1 ">Cherecher une formation</h3> --}}

                    {{-- <form action="{{ route('searchCourse') }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Rechercher ..." name="course">
                            <div class="input-group-append">
                                <span class="input-group-text bg-light">
                                    <button
                                        style="background: none;
                                                                                                                        color: inherit;
                                                                                                                        border: none;
                                                                                                                        padding: 0;
                                                                                                                        font: inherit;
                                                                                                                        cursor: pointer;
                                                                                                                        outline: inherit;">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0099FF"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
