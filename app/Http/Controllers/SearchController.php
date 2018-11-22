<?php

namespace App\Http\Controllers;
use App\Internship;
use App\Student;
use App\Company;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $internships = Internship::search($request->search)->get();
        $students = Student::search($request->search)->get();
        $companies = Company::search($request->search)->get();

        return view('search.show', compact('internships', 'students', 'companies'));
    }
}
