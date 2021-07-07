@extends('layouts.welcome')


@section('css')

    <style type="text/css">
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>

@endsection
@section('content')


    <div class="container-fluid  h-100 margin-top ">
        <div class="align-items-center bg-white p-4">
            @auth
                @if (count($course->students) > 0)
                    @php
                        header('Location: ' . URL::to('/dashboard/student'), true, 302);
                        exit();
                    @endphp
                @else
                    @if (Auth::user()->type == 'student')
                        <div class="card text-center">
                            <div class="card-header">
                                <h1 class="text-center mt-4 text-lightblue">Order informations</h1>
                            </div>
                            <div class="card-body">
                                <div class="col-md-4 offset-md-4 bg-light p-3">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="{{ asset('/storage/' . $course->picture) }}" alt="" width="100%"
                                                height="150px" srcset="">
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="font-weight-bold">{{ $course->title }}</h5>
                                            <h5>Prix : {{ $course->price }}$</h5>
                                        </div>
                                    </div>
                                    @if (count($course->students) > 0)
                                        <h3 class="mt-4">Course déja acheté</h3>
                                        <button class="btn bg-lightblue text-white">Vous êtes déjà inscrit à ce cours. Cliquez
                                            ici
                                            pour le voir</button>
                                    @else
                                        <form action="{{ route('course.charge', ['id' => $course->id]) }}" method="post"
                                            id="payment-form">
                                            @csrf
                                            <div class="mt-3">
                                                <label for="card-element">
                                                    Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>

                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>

                                            <button class="btn btn-primary mt-3">Acheter</button>
                                            <div class="spinner-border text-primary" id="loading" style="display: none"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </form>
                                    @endif

                                </div>
                            </div>

                        </div>



                    @else
                        <h1 class="text-center mt-4 text-lightblue"></h1>
                    @endif
                @endif
            @endauth
            @guest
                <div class="card text-center mt-4">
                    <div class="card-header bg-lightblue">
                        <div class="mt-3">
                            <h2 class="card-title  text-light">Inscrivez-vous et commencez à apprendre !</h2>
                        </div>
                    </div>
                    <div class="card-body m-2">
                        <div class="vertical-center ">
                            <div class="container">
                                <div class="row justify-content-center ">
                                    <div class="col-md-6">
                                        <div class="login-card shadow pt-2">
                                            <div class="text-center m-3">
                                                <h1 class="font-weight-bold">S’inscrire</h1>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('register') }}">
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
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">adresse
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
                                                        <label for="password" class="col-md-4 col-form-label text-md-right">Mot
                                                            de passe :</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" required autocomplete="new-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="password-confirm"
                                                            class="col-md-4 col-form-label text-md-right">Répéter mot de passe
                                                            :</label>

                                                        <div class="col-md-6">
                                                            <input id="password-confirm" type="password" class="form-control"
                                                                name="password_confirmation" required
                                                                autocomplete="new-password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-0">
                                                        <center>
                                                            <button type="submit" class="btn bg-lightblue text-white">
                                                                S’inscrire
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

            @endguest
        </div>
    </div>


@endsection
@section('scripts')

    <script src="https://js.stripe.com/v3/"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            console.log("ready!");
        });
        window.onload = function() {
            var stripe = Stripe(
                'pk_test_51IzgGEJ7bKEux3Z9M0ZzQjAAl0AZ2iDfOtipuwiC5V5bisM8Gy4HKQPa4zI6KuRQFzTHGpdlF4fxjqPjE7WE1Kov00HX6Q2G8L'
            );
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            var card = elements.create('card', {
                style: style
            });
            card.mount('#card-element');
            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                var loading = document.getElementById("loading");
                loading.style.display = "block";
                // Submit the form
                form.submit();
            }
        }

    </script>

@endsection
