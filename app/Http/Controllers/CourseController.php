<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Formateur;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('formateur');
    }
    public function create()
    {
        $formateurs = User::where('type', 'formateur')->with(['formateur'])->get()->except(Auth::id());
        return view('formateur.courses.addCourse', [
            'formateurs' => $formateurs
        ]);
    }

    public function store(CourseRequest $request)
    {
        $slug = Str::slug($request->title, '-');
        // $extension = $request->file('picture')->extension();
        $path = Storage::put('coursesImages', $request->file('picture'));
        //  $request->file('picture')->store('coursesImages', $slug . '.' . $extension);
        $course =  Course::create([
            'title' => $request->title,
            'slug' => $slug,
            'level' => $request->level,
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price,
            'picture' => $path,
            'hours' => $request->hours,
        ]);
        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['tag' => $tagName]);
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        }
        $course->tags()->sync($tagIds);
        $course->formateurs()->attach(Formateur::where('formateur_id', Auth::id())->value('id'));
        if ($request->formateurs) {
            $course->formateurs()->attach($request->formateurs);
        }
        Alert::success('votre formation a été créé avec succès', 'Success Message');
        return redirect()->route('formateurdashboard');
    }
    public function edit()
    {
        $courses = Formateur::where('formateur_id', Auth::id())->with(['courses'])->get();
        return view('formateur.courses.editCourse', [
            'courses' => $courses
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|unique:courses|max:255',
            'level' => 'required|in:Débutant,Intermédiaire,Avancé',
            'type' => 'required',
            'description'  => 'required',
            'price'  => 'required|integer',
            'hours' => 'required|integer',
        ]);
        $course = Course::find($id);
        $slug = Str::slug($request->title, '-');
        if ($request->hasFile('picture')) {
            Storage::delete($course->picture);
            $image = $request->file('picture');
            $saveimage = Storage::put('coursesImages', $image);
            $course->picture = $saveimage;
        }
        $course->title = $request->title;
        $course->slug = $slug;
        $course->level = $request->level;
        $course->type = $request->type;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->hours = $request->hours;
        $course->save();
        Alert::success('votre formation a été modifié avec succès', '');
        return redirect()->route('courses.edit');
    }
    public function deleteEpisode()
    {
    }
}
