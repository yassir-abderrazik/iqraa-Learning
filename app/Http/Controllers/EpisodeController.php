<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Models\Course;
use App\Models\Episode;
use App\Models\Formateur;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('formateur');
    }

    public function index()
    {
        return view('formateur.episodes.episodes');
    }

    public function create()
    {
        $courses = Formateur::where('formateur_id', Auth::id())->with(['courses:id,title'])->get();
        return view('formateur.episodes.episodes', [
            'courses' => $courses
        ]);
    }
    public function store(EpisodeRequest $request)
    {
        $slug = Str::slug($request->title, '-');
        $extension = $request->file('path')->extension();
        $path = Storage::disk('local')->put($request->course, $request->file('path'));
        $episode = Episode::create([
            'course_id' => $request->course,
            'title' => $request->title,
            'slug' => $slug,
            'path' => $path,
            'author' => Auth::user()->name,
        ]);
        Alert::success('votre épisode a été créé avec succès', '');
        return redirect()->route('episodes.edit');
    }
    public function edit()
    {
        $courses = Course::whereHas('formateurs', function ($q) {
            $q->where('formateurs.formateur_id', Auth::id());
        })->with(['episodes' => function ($query) {
            $query->orderBy('created_at', 'desc')->limit(10);
        }])->get(['id', 'title']);
        // die($courses);
        return view('formateur.episodes.episodesEdit', [
            'courses' => $courses
        ]);
    }

    public function update(Request $request, $id)
    {
        $episode = Episode::find($id);
        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('path')) {
            Storage::delete($episode->path);
            $path = Storage::disk('local')->put($id, $request->file('path'));
            $episode->path = $path;
        }
        $episode->title = $request->title;
        $episode->slug = $slug;
        $episode->save();
        Alert::success('votre épisode a été modifié avec succès', '');
        return redirect()->route('episodes.edit');
    }

    public function delete($id)
    {
        $episode = Episode::find($id);
        $episode->delete();
        Alert::success('votre formation a été supprimé avec succès', '');
        return redirect()->route('episodes.edit');
    }
    function getVideo($id, $path)
    {
        $video = Storage::disk('local')->get($id . '/' . $path);
        echo $video;
    }
    function getPDF($id, $path)
    {
        return response()->download(storage_path('app/' . $id . '/' . $path));
    }

    public function getEpisodes(Request $request)
    {
        $id = $request->course;
        $courses = Course::whereHas('formateurs', function ($q) {
            $q->where('formateurs.formateur_id', Auth::id());
        })->with(['episodes' => function ($query) use ($id) {
            $query->where('course_id', $id)->orderBy('created_at', 'desc');
        }])->get(['id', 'title']);
        return view('formateur.episodes.episodesEdit', [
            'courses' => $courses
        ]);
    }
}
