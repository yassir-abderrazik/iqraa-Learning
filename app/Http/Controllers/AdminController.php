<?php

namespace App\Http\Controllers;

use App\Mail\NewUserMail;
use App\Mail\ValidationCourse;
use App\Mail\ValidationFormateurRequestReject;
use App\Models\Course;
use App\Models\Formateur;
use App\Models\RequestFormateur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $course = Course::count();
        $courses = Course::orderBy('created_at', 'desc')->take(5)->with(['formateurs'])->get(['id', 'title', 'created_at']);
        $students = User::where('type', 'student')->count();
        $formateur = User::where('type', 'formateur')->count();
        return view('admin.dashboard', [
            'courses' => $courses,
            'course' => $course,
            'students' => $students,
            'formateur' => $formateur,
        ]);
    }

    public function users(Request $request)
    {

        // die($request->type);
        if ($request->type) {
            $users = User::orderBy('created_at', 'desc')->where('type', $request->type)->paginate('10');
        } else {
            $users = User::orderBy('created_at', 'desc')->paginate('10');
        }
        return view('admin.users.users', [
            'users' => $users,
        ]);
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);
        if ($request->type == "formateur") {
            $formateur = new Formateur();
            $formateur->formateur_id = $user->id;
            $user->formateur()->save($formateur);
        }
        Alert::toast('Ajouté avec succès', 'success');
        return redirect()->route('users');
    }
    public function statistics()
    {
        $courses = Course::with(['students'])->withCount('students')->get('title');
        $data = [];
        foreach ($courses as $course) {
            $data['label'][] = $course->title;
            $data['data'][] =  $course->students_count;

            $i = 0;
            foreach ($course->students as $student) {
                $i = $student->pivot->price + $i;
            }
            $data['price'][] = $i;
        }
        $data['chart_data'] = json_encode($data);

        return view('admin.statistics.statistics', [
            'data' => $data,
        ]);
    }

    public function formateursRequest()
    {
        $requests = RequestFormateur::where('validation', null)->orderBy('created_at', 'desc')->get();
        return view('admin.validationFormateurRequest', [
            'requests' => $requests,
        ]);
    }
    public function validateFormateurRequest(Request $request, $id)
    {
        $demande = RequestFormateur::find($id);
        if ($request->validation == 1) {
            $password = Str::random(14);
            $user =  User::create([
                'name' => $demande->name,
                'email' => $demande->email,
                'password' => Hash::make($password),
                'type' => 'formateur',
            ]);
            $formateur = new Formateur();
            $formateur->formateur_id = $user->id;
            $user->formateur()->save($formateur);
            Mail::to($demande->email)->send(new NewUserMail($user, $password));
        } else {
            Mail::to($demande->email)->send(new ValidationFormateurRequestReject($demande));
        }
        $demande->validation = $request->validation;
        $demande->save();
        Alert::success('done', 'success');
        return redirect()->route('formateursRequestAdmin');
    }
}
