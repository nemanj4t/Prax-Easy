<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Faculty;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('type', $request->type)->paginate(10);

        return view('admin.home', compact('users'));
    }

    public function createFaculty()
    {
        return view('admin.create-faculty');
    }

    public function storeFaculty(Request $request)
    {
        //validate request
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed'
        ]);
        //create user
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 'faculty';
        $user->save();
        //create company
        $faculty = new Faculty;
        $faculty->user_id = $user->id;
        $faculty->name = $request->name;
        $faculty->description = 'O nama';
        $faculty->save();

        //redirect
        return redirect()->route('admin.home');
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect()->back();
    }

    public function showStudent($id)
    {
        $user = User::find($id);
        return view('admin.student-show', compact('user'));
    }

    public function showFaculty($id)
    {
        $user = User::find($id);
        return view('admin.faculty-show', compact('user'));
    }

    public function showCompany($id)
    {
        $user = User::find($id);
        return view('admin.company-show', compact('user'));
    }
}
