<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\RequestFormateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Share;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function searchCategories($category)
    {
        $courses = Course::where('type', $category)->where('validation', 1)
            ->orderBy('created_at', 'desc')
            ->with(['formateurs.user', 'tags'])->paginate(8);
        return view('home.categories', [
            'courses' => $courses
        ]);
    }
    public function searchCourse(Request $request)
    {
        $courses = Course::where('title', 'LIKE', '%' . $request->course . '%')->where('validation', 1)
            ->orderBy('created_at', 'desc')
            ->with(['formateurs.user', 'tags'])->paginate(8);
        return view('home.categories', [
            'courses' => $courses
        ]);
    }

    public function searchWithTag($id)
    {
        $courses = Course::where('validation', 1)->with(['formateurs.user', 'tags'])
            ->whereHas('tags', function ($q) use ($id) {
                $q->where('tag_id', $id);
            })->orderBy('created_at', 'desc')->paginate(8);

        return view('home.categories', [
            'courses' => $courses
        ]);
    }

    public function searchWithAuthor($id)
    {
        $courses = Course::where('validation', 1)->with(['tags', 'formateurs.user'])
            ->whereHas('formateurs', function ($q) use ($id) {
                $q->where('formateurs.formateur_id', $id);
            })->orderBy('created_at', 'desc')->paginate(8);

        return view('home.categories', [
            'courses' => $courses
        ]);
    }
    public function course($slug)
    {
        $course = Course::where('slug', $slug)->where('validation', 1)->with(['tags', 'formateurs.user', 'episodes'])
            ->orderBy('created_at', 'desc')->first();
        $course->views = $course->views + 1;
        $course->save();
        $socialShare = \Share::currentPage()->facebook()
            ->twitter()
            ->whatsapp()
            ->telegram();
        return view('home.course', [
            'course' => $course,
            'socialShare' => $socialShare
        ]);
    }
    public function checkoutBuy($slug)
    {
        $course = Course::where('slug', $slug)->where('validation', 1)->with(["students" => function ($q) {
            $q->where('user_id', Auth::id());
        }])->first(['id', 'title', 'price', 'picture']);
        // die($course);
        return view('home.buyCourse', [
            'course' => $course
        ]);
    }
    public function formateurRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:request_formateurs|unique:users',
            'file' => 'required|max:3072',
        ]);
        $path = Storage::put('formateursRequests', $request->file('file'));
        // $path = $request->file('file')->store('public');

        $formateurR = RequestFormateur::create([
            'name' => $request->name,
            'email' => $request->email,
            'file' => $path,
        ]);

        Alert::toast('votre demande a été envoyer', 'success');
        return redirect()->route('welcome');
    }
}
