<?php

namespace App\Http\Controllers;

use App\Mail\ValidationCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ValidateController extends Controller
{
    public function courseValidation()
    {
        $courses = Course::where('validation', 0)->with('formateurs.user')->get();
        return view('validator.dashboard', [
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
        return redirect()->route('dashboardValidate');
    }
}
