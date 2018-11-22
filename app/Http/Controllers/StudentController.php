<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Internship;
use App\User;
use App\Student;
use App\Faculty;
use App\Application;
use DB;
use Illuminate\Validation\Rules\In;
use Image;
use Storage;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $internships = Internship::all();

        $applications = Application::where('student_id', $user->student->id)->get();
        $applicationsAccepted = Application::where('student_id', $user->student->id)->where('accepted',true)->get();
        return view('student.home', compact('internships', 'user', 'applications','applicationsAccepted'));
    }

    public function showProfile()
    {
        $user = auth()->user();

        $recommendations = $user->student->recommendations;
        return view('student.profile', compact('user', 'recommendations'));
    }

    public function edit()
    {
        $faculties = Faculty::all();
        $user = auth()->user();
        return view('student.edit', compact('user', 'faculties'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'student_number' => 'required',
            'avatar' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('avatar'))
        {
            if($user->avatar != 'default.jpg')
            {
                Storage::disk('public')->delete('/storage/uploads/avatars/'.$user->avatar);
            }
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            //Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'. $filename));
            $path = $request->file('avatar')->storeAs('public/uploads/avatars',$filename);
            $user->avatar = $filename;
        }
        $user->student->first_name = $request->first_name;
        $user->student->last_name = $request->last_name;
        $user->student->student_number = $request->student_number;
        $user->student->faculty_id = $request->faculty_id;

        $user->save();
        $user->student->save();

        return redirect()->route('student.profile')->with('success', 'Vaši podaci su uspešno sačuvani');;
    }

    public function show($id)
    {
        $user = User::find($id);
        $student = $user->student;
        $recommendations = $student->recommendations;

        return view('student.profile', compact('user', 'recommendations'));
    }

    public function application(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'cv' => 'required'
        ]);

        $application = new Application;

        if($request->hasFile('cv'))
        {
            $cv = $request->file('cv');
            $filename = time() . "." . $cv->getClientOriginalExtension();
            $path = $request->file('cv')->storeAs('public/uploads/cvs', $filename);
            $application->cv = $filename;
        }
        else
        {
            $application->cv = 'nesto';
        }
        $application->description = $request->description;
        $application->student_id  = auth()->user()->student->id;
        $application->internship_id = $request->internship_id;
        $application->accepted = false;
        $application->save();

        return redirect()->route('student.home')->with('success', 'Uspešno ste aplicirali na praksu');
    }

    public function assignInternship(Request $request)
    {
        $app = Application::find($request->application_id);
        $app->internship->dodaj();
        $student = $app->student;
        $student->internships()->attach($app->internship_id);

        return redirect()->back()->with('success', 'Uspešno ste se upisali na praksu!');
    }
}
