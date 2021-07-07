<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }
    public function index()
    {
        $courses = Course::whereHas('students', function ($q) {
            $q->where('user_id', Auth::id());
        })->with(['formateurs.user'])
            ->with(['episodes' => function ($q) {
                $q->withCount('student');
            }])
            ->withCount('episodes')->get(['id', 'title', 'picture']);

        return view('student.dashboard', [
            'courses' => $courses,
        ]);
    }
    public function getStudentCourseByCategory($category)
    {
        $courses = Course::where('type', $category)->whereHas('students', function ($q) {
            $q->where('user_id', Auth::id());
        })->with(['formateurs.user'])
            ->with(['episodes' => function ($q) {
                $q->withCount('student');
            }])
            ->withCount('episodes')->get(['id', 'title', 'picture']);

        return view('student.dashboard', [
            'courses' => $courses,
        ]);
    }
    public function getStudentCourseSearch(Request $request)
    {
        $courses = Course::where('title', 'LIKE', '%' . $request->course . '%')->whereHas('students', function ($q) {
            $q->where('user_id', Auth::id());
        })->with(['formateurs.user'])
            ->with(['episodes' => function ($q) {
                $q->withCount('student');
            }])
            ->withCount('episodes')->get(['id', 'title', 'picture']);

        return view('student.dashboard', [
            'courses' => $courses,
        ]);
    }
    public function lectures($id)
    {
        $creditFilter = function ($q) {
            $q->where('user_id', Auth::id());
        };
        $course = Course::whereHas('students', function ($q) {
            $q->where('user_id', Auth::id());
        })->with(['episodes' => function ($q) {
            $q->withCount('student');
        }])->with(['students' => $creditFilter])->findOrFail($id);
        return view('student.lectures', [
            'course' => $course,
        ]);
    }
    public function getVideo($id)
    {
        $episode = Episode::where('id', $id)->value('path');
        $video = Storage::disk('local')->get($episode);
        echo $video;
    }
    public function getPdf($id)
    {
        $pdf = Episode::where('id', $id)->value('path');
        return response()->file(storage_path('app/' . $pdf));
    }
    public function episodeFinish($id)
    {
        $episode = Episode::findOrFail($id);
        $episode->student()->syncWithoutDetaching(Auth::id());
        return response()->json('success');
    }
    public function downloadCertificate($id)
    {
        $course = Course::find($id);
        // $url = response()->file(storage_path('app/public/certificat.jpg'));
        // $data = [
        //     'name' => Auth::user()->name,
        //     'course' => $course,
        // ];
        $pdf = PDF::loadView('student.certificat', $course)->setPaper('a4', 'landscape');
        return $pdf->download('certificat-' . $course->slug . '.pdf');
    }
}
