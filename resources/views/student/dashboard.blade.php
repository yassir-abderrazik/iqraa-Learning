@extends('layouts.student')

@section('content')
    <div class="container mt-4">

        <div class="row">
            <div class="col-md-6">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #0099FF">
                        Catégiories
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Développement Web']) }}">Développement
                            Web</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Business']) }}">Business</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Finance']) }}">Finance</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Développement mobile']) }}">Développement
                            mobile</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Comptabilité']) }}">Comptabilité</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Big Data']) }}">Big Data</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Design']) }}">Design</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Marketing']) }}">Marketing</a>
                        <a class="dropdown-item borderLeft "
                            href="{{ route('getStudentCourseByCategory', ['category' => 'Photographie']) }}">Photographie</a>

                    </div>
                </div>
            </div>
            <div class="col-md-6  justify-content-end d-flex">
                <form action="{{ route('getStudentCourseSearch') }}" class="form-inline my-2 my-lg-0" method="POST">
                    @method('POST')
                    @csrf
                    <input class="form-control mr-sm-2" name="course" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
                        style="background-color: #0099FF;color: white;">Search</button>
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row mt-5">
            @foreach ($courses as $course)
                <div class="col-md-4  mt-3">
                    <div class="card " style="width: 18rem;">
                        <img src="{{ asset('/storage/' . $course->picture) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"> <a href="{{ route('lectures', ['id' => $course->id]) }}"
                                    class="text-justify text-dark">{{ $course->title }}</a></h5>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($course->episodes as $episode)
                                @php
                                    $i = $episode->student_count + $i;
                                @endphp
                            @endforeach

                            <div class="progress">
                                <div class="progress-bar bg-lightblue" role="progressbar" style="width: @if ($i=='0' ) @else {{ ceil(($i * 100) / sizeof($course->episodes)) }}% @endif" aria-valuenow="
                                                                                                                                                                                                                                                                                                                            
                                                                                                                                                                                                                                                                               
                                                                                                                                                                                                                               
                                                                                                                                                                               
                                                                                                                               
                                                                            @if ($i=='0'
                                    )
                                @else {{ ceil(($i * 100) / sizeof($course->episodes)) }}
                                    @endif"
                                    aria-valuemin="0" aria-valuemax="100">
                                @if ($i == '0') @else
                                        {{ ceil(($i * 100) / sizeof($course->episodes)) }}% @endif
                                </div>
                            </div>
                            <p class="card-text mt-3">
                                Formateur (s) : @foreach ($course->formateurs as $formateur)
                                    <img src="{{ asset('/storage/' . $formateur->user->avatar) }}" width="30px"
                                        alt="...">
                                    {{ $formateur->user->name }}
                                @endforeach
                            </p>
                            @if (sizeof($course->episodes) > 0)
                                @if (ceil(($i * 100) / sizeof($course->episodes)) == '100')
                                    <a href="{{ route('lectures', ['id' => $course->id]) }}"
                                        class="btn btn-primary">Términé</a>
                                    <a href="{{ route('downloadCertificate', ['id' => $course->id]) }}"
                                        class="text-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFD700"
                                            class="bi bi-trophy-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935z" />
                                        </svg>certificat</a>
                                @else
                                    <center>
                                        <a href="{{ route('lectures', ['id' => $course->id]) }}"
                                            class="btn btn-primary">Continue</a>
                                    </center>
                                @endif
                            @else
                                <center>
                                    <a href="{{ route('lectures', ['id' => $course->id]) }}"
                                        class="btn btn-primary">Continue</a>
                                </center>
                            @endif

                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>



@endsection
