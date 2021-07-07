<?php

namespace App\Http\Controllers;

use App\Mail\ValidationCourse;
use App\Models\Course;
use App\Models\Formateur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function courseValidation()
    {
        $courses = Course::where('validation', 0)->with('formateurs.user')->get();
        return view('admin.courses.courseValidation', [
            'courses' => $courses,
        ]);
    }
    public function validateCourse($id)
    {
        $course = Course::with('formateurs.user')->find($id);
        $course->validation = 1;
        foreach ($course->formateurs as $formateur) {
            Mail::to($formateur->user->email)->send(new ValidationCourse($course));
        }
        $course->save();
        Alert::success('Validé', '');
        return redirect()->route('courseValidation');
    }
}
