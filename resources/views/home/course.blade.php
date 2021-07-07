@extends('layouts.welcome')

@section('header')
    <div style="background: @switch($course->type)               @case('Développement Web')
            url('../storage/categories/devweb.jpg')
            @break
            @case('Business') url('../storage/categories/business.jpg')@break
            @case('Finance') url('../storage/categories/finnace.jpg')@break
            @case('Développement mobile') url('../storage/categories/devmobile.jpg')
            @break
            @case('Comptabilité') url('../storage/categories/compta.jpg')@break
            @case('Big Data') url('../storage/categories/bigdata.jpg')@break
            @case('Design') url('../storage/categories/design.jpg')@break
            @case('Marketing') url('../storage/categories/marketing.jpg')@break
            @case('Photographie') url('../storage/categories/photographie.jpg')@break
            @default
                url('../storage/categories/all.jpg')
        @endswitch;" class="bg-course">
        <div class="container  h-100 margin-top ">
            <div class="align-items-center p-4">
                <h1 class="text-light text-center mt-5 display-3 d-none d-md-block"> {{ $course->title }}</h1>
                <h1 class="text-light text-center mt-5  d-block d-sm-none"> {{ $course->title }}</h1><br><br>
                <center>
                    <a href="{{ route('course.buy', ['slug' => $course->slug]) }}"
                        class="btn btn-lg bg-lightblue text-light">Acheter Maintenant
                        <strong>{{ $course->price }}$</strong></a>
                </center>
            </div>
        </div>
    </div>
@endsection
@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <img src="{{ asset('/storage/' . $course->picture) }}" alt="" width="100%" height="450px" srcset="">
            <div class="mt-2 text-center ">

                {!! $socialShare !!}
            </div>
            <div class="bg-white p-2">
                {!! $course->description !!}
            </div>
            @foreach ($course->formateurs as $formateur)
                <h3 class="mt-3">Formateur <strong class="text-lightblue">{{ $formateur->user->name }}</strong></h3>
                <div class="row secondary mt-3">
                    <div class="col-md-4">
                        <img src="{{ asset('/storage/' . $formateur->user->avatar) }}" alt="" width="100%"
                            height="100px" srcset="">
                    </div>
                    <div class="col-md-8">
                        <p>{{ $formateur->biography }}</p>
                    </div>
                </div>
            @endforeach
            <h1 class="bg-lightblue text-light mt-4">Course Curriculum</h1>
            <table class="table">
                <tbody>
                    @foreach ($course->episodes as $episode)
                        <tr>
                            <th scope="row">
                                @if (pathinfo($episode->path, PATHINFO_EXTENSION) == 'mp4')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0099FF"
                                        class="bi bi-caret-right-square-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.5 10a.5.5 0 0 0 .832.374l4.5-4a.5.5 0 0 0 0-.748l-4.5-4A.5.5 0 0 0 5.5 4v8z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#0099FF"
                                        class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                        <path fill-rule="evenodd"
                                            d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                    </svg>
                                @endif
                                {{ $episode->title }}
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container mt-3">
    <h1 class="text-center font-weight-bold">Commencez maintenant!</h1>
    <center>
        <a href="" class="btn btn-lg bg-lightblue text-light" style="border-radius: 32px !important">Acheter
            Maintenant</a>
    </center>
</div>
@endsection
