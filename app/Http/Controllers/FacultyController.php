<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;

class FacultyController extends Controller
{
    public function index(Request $request)
    {
        $years = Student::select('school_year')->groupBy('school_year')->get();
        $students = Student::where('faculty_id', auth()->user()->faculty->id)->paginate(10);
        if ($request->year)
        {
            $students = Student::where('faculty_id', auth()->user()->faculty->id)->where('school_year', $request->year)->paginate(10);
        }
        return view('faculty.home', compact('students', 'years'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('faculty.profile', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('faculty.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('faculty.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'avatar' => 'image|nullable|max:1999',
            'description' => 'required'
        ]);

        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            //Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'. $filename));
            $path = $request->file('avatar')->storeAs('public/uploads/avatars',$filename);
            $user->avatar = $filename;
        }
        $user->faculty->name = $request->name;
        $user->faculty->address = $request->address;
        $user->faculty->phone_number = $request->phone_number;
        $user->faculty->description = $request->description;

        $user->save();
        $user->faculty->save();

        return redirect()->route('faculty.profile')->with('success', 'Vaši podaci su uspešno sačuvani');
    }
}
