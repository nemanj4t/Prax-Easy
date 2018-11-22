<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\User;
use App\Internship;
use App\Application;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{
    public function index()
    {
        $internships = Internship::where('company_id', Auth::user()->company->id)->orderBy('created_at', 'desc')->get();
        //$internships = Company::find(Auth::user()->company->id)->internships;
        return view('company.home', compact('internships'));
    }

    public function  showProfile()
    {
        $user = auth()->user();
        $comments = $user->company->comments;
        return view('company.profile', compact('user', 'comments'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $company = $user->company;
        $comments = $company->comments;
        return view('company.profile', compact('user', 'comments'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('company.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'avatar' => 'image|nullable|max:1999',
            'description' => 'required',
        ]);

        if($request->hasFile('avatar'))
        {
            /*if($request->avatar !== 'default.jpg')
            {
                Storage::disk('public')->delete('public/uploads/avatars/'.$user->avatar);
            }*/
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            //Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'. $filename));
            $path = $request->file('avatar')->storeAs('public/uploads/avatars',$filename);
            $user->avatar = $filename;
        }
        $user->company->name = $request->name;
        $user->company->address = $request->address;
        $user->company->phone_number = $request->phone_number;
        $user->company->description = $request->description;

        $user->save();
        $user->company->save();

        return redirect()->route('company.profile')->with('success', 'Vaši podaci su uspešno sačuvani');
    }

    public function allApplications()
    {
        $internships = Internship::where('company_id', auth()->user()->company->id)->orderBy('created_at', 'desc')->get();
        return view('company.applicationManager', compact('internships'));
    }

    public function acceptApplication(Request $request)
    {
        Application::where('id', $request->application_id)->update(['accepted' => true]);
        return redirect()->route('company.applications')->with('success', 'Uspešno ste prihvatili aplikaciju');
    }

    public function declineApplication(Request $request)
    {
        Application::where('id', $request->application_id)->delete();
        return redirect()->route('company.applications')->with('error', 'Odbili ste aplikaciju');
    }

    public function obnovi($id)
    {
        $internship = Internship::find($id);
        return view('internship.obnovi', compact('internship'));
    }

}
