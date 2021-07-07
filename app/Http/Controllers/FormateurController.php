<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    public function index()
    {
        $courses = Course::whereHas('formateurs', function ($q) {
            $q->where('formateurs.formateur_id', Auth::id());
        })->with(['episodes' => function ($q) {
            $q->orderBy('created_at', 'desc')->take(5);
        }])->get();
        return view('formateur.dashboard', [
            'courses' => $courses
        ]);
    }
    public function statistics()
    {
        $courses = Course::whereHas('formateurs', function ($q) {
            $q->where('formateurs.formateur_id', Auth::id());
        })->with(['students'])->withCount('students')->get('title');
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

        return view('formateur.statistics.statistics', [
            'data' => $data,
        ]);
    }
}
