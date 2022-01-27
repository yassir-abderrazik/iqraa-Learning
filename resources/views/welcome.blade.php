@extends('layouts.welcome')

@section('header')
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-75 mt-5 align-items-center">
                <div class="col-md-6 mt-5 text-center mt-3">
                    <h1 class="font-weight-bold my-4 text-white" style="font-size:62px">Votre parcours vers le succès</h1>
                    <br>
                    <p class="h3 mb-5 text-dark">Développez vos compétences grâce à des cours, des certificats et des
                        diplômes en
                        ligne
                        proposés par les meilleures universités et entreprises au monde.</p>
                    <a href="/register" class="btn btn-lg text-white"
                        style="background-color: #0099FF; padding: 20px 5px;">Inscrivez-vous
                        gratuitement</a>
                </div>
                <div class="col-md-6 mt-5 text-center mt-3 d-none d-md-block">
                    <center>
                        <img src="{{ asset('/storage/image-learn.webp') }}" alt="" srcset=""
                            style="  border-radius: 50%;
                                                                                                                                " class="img-fluid">
                    </center>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')

    <h1 class="text-center text-dark">Atteignez vos objectifs avec IQRAA LEARNING</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('/storage/comp.jpg') }}" height="180px" alt="Card image cap">
                    <div class="card-body" style="background-color: #0099FF">
                        <h5 class="card-title text-white text-center font-weight-bold">Apprenez les
                            compétences les plus récentes
                            comme la conception graphique, Pythonet bien d'autres</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('/storage/carriere.png') }}" height="180px"
                        alt="Card image cap">
                    <div class="card-body" style="background-color: #0099FF">
                        <h5 class="card-title text-white text-center font-weight-bold">Préparez-vous
                            pour une carrière
                            dans des domaines très convoités comme l'informatique, l'IA et l'ingénierie du cloud</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('/storage/certificat.png') }}" height="180px"
                        alt="Card image cap">
                    <div class="card-body" style="background-color: #0099FF">
                        <h5 class="card-title text-white text-center font-weight-bold">Obtenez
                            un diplôme
                            d'une grande université dans le domaine du commerce, de l'informatique, et bien plus encore</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 class="text-center text-dark">Catégories</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="" src="{{ asset('/storage/devweb.jpg') }}" height="180px" alt="Card image cap">
                    <div class="card-body" style="background-color: white">
                        <h5 class="card-title  text-center font-weight-bold" style="color: #0099FF">Dévelopement Web</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('/storage/design.jpg') }}" height="180px"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-center font-weight-bold" style="color: #0099FF">Design</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="{{ asset('/storage/photographie.jpg') }}" height="180px"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title  text-center font-weight-bold" style="color: #0099FF">Photographie</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <center>

                    <img class="" src="{{ asset('/storage/formateur.jpg') }}" height="250px">
                </center>
            </div>
            <div class="col-md-6">
                <h2 class="">Devenir formateur</h2>
                <p class="p-3">Les meilleurs formateursdonnent des cours à des participants sur IQRAALEARNIN. Nous vous
                    offrons les
                    outils et les compétences nécessaires pour enseigner ce que vous aimez.</p>
                <center>
                    <a href="{{ route('formateurRequest') }}" class="btn text-white"
                        style="background-color: #0099FF;">contactez-nous</a>
                </center>
            </div>
        </div>
    </div>
@endsection
