@extends('layouts.student')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 text-center">
                <div class=" p-3 w-100 mt-3" style="background-color: white;">
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="" height="150px" id="avatar">
                    <h3 class="mt-2" style="color: #2ab7ca;">{{ Auth::user()->name }}</h3>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <strong class="badge badge-secondary" style="font-size: 15px;"> Email : </strong>
                        </div>
                        <div class="col-md-8">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <strong class="badge badge-secondary" style="font-size: 15px;"> Mot de passe : </strong>
                        </div>
                        <div class="col-md-8">*********
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <form class="m-3" action="{{ route('editPassword') }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group ">
                                <label for="password" class="form-label">Mot de passe actuel :</label>
                                <input id="password" type="password" class="form-control" name="password">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="newPassword" class="form-label">Nouveau mot de passe :</label>
                                <input id="newPassword" type="password" class="form-control" name="newPassword">
                                @error('newPassword')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label for="newPasswordRepeat" class="form-label">Nouveau mot de passe :</label>
                                <input id="newPasswordRepeat" type="password" class="form-control" name="newPasswordRepeat">
                                @error('newPasswordRepeat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier mot de passe</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-8">

                {{-- afficher les informations STARt --}}
                <div class=" p-3 w-100 mt-3" style="background-color: white;">
                    <h3 class="mt-2 text-center" style="color: #2ab7ca;">Vos informations</h3>

                    <form class="m-3" action="{{ route('editInformations') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="name" class="form-label">Nom :</label>
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="avatar" class="form-label">Photo profile :</label>
                                    <input id="avatar" type="file" class="form-control-file" name="avatar">
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="phone" class="form-label">Téléphone :</label>
                                    <input id="phone" type="tel" pattern="[0-9]{10}" value="{{ $user->student->phone }}"
                                        class="form-control" name="phone">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="address" class="form-label">Adresse :</label>
                                    <input id="address" type="text" class="form-control" name="address"
                                        value="{{ $user->student->address }}">
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="city" class="form-label">Ville :</label>
                                    <input id="city" type="text" class="form-control" name="city"
                                        value="{{ $user->student->city }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="state" class="form-label">Pays :</label>
                                    <input id="state" type="text" class="form-control" name="state"
                                        value="{{ $user->student->state }}">
                                    @error('state')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="zip" class="form-label">ZIP :</label>
                                    <input id="zip" type="number" class="form-control" name="zip"
                                        value="{{ $user->student->zip }}">
                                    @error('zip')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var extension = this.files[0].type;
                    const source = URL.createObjectURL(this.files[0]); // set src to file url
                    if (extension.match(/image*/)) {
                        var avatar = document.getElementById('avatar');
                        avatar.src = source;
                    } else {
                        console.log('not image')
                    }

                }
            });
        });
    </script>
@endsection
