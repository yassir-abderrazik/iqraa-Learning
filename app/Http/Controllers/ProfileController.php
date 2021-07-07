<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }
    public function index()
    {
        $user = User::with('student')->find(Auth::id());
        return view('student.profilEdit', [
            'user' => $user
        ]);
    }
    public function editPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'newPassword' => ['required'],
            'newPasswordRepeat' => ['same:newPassword'],
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->newPassword);
        $user->update();
        Alert::toast('votre mot de passe est modifié avec succès', 'success');
        Auth::logout();
        return redirect()->route('login');
    }
    public function editInformations(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50', 'min:8'],
            'avatar' => ['image'],
            'phone' => ['required'],
            'address' => ['required', 'max:100'],
            'city' => ['required', 'max:50'],
            'state' => ['required'],
            'zip' => ['required', 'integer'],
        ]);

        $user = User::with('student')->find(Auth::id());
        if ($request->hasFile('avatar')) {
            if ($user->avatar !== "avatar/avatar-default.png") {
                Storage::delete($user->avatar);
            }
            $image = $request->file('avatar');
            $saveimage = Storage::put('avatar', $image);
            $user->avatar = $saveimage;
        }
        $user->name = $request->name;
        $user->student->phone = $request->phone;
        $user->student->address = $request->address;
        $user->student->city = $request->city;
        $user->student->state = $request->state;
        $user->student->zip = $request->zip;
        $user->student->update();
        $user->update();
        Alert::toast('modifié avec succès', 'success');
        return redirect()->route('studentProfil');
    }
}
