<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Internship;
use Auth;
class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.createInternship');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //validate request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'address' => 'required',
        ]);
        //create internship
        $internship = new Internship;
        $internship->title = $request->title;
        $internship->description = $request->description;
        $internship->duration = $request->duration;
        $internship->address = $request->address;
        $internship->end = $request->end;
        $internship->maximum_number = $request->maximum_number;
        $internship->work_hours = $request->work_hours;
        $internship->company_id = Auth::user()->company->id;
        $internship->save();

        $this->assignTag($request);
        //redirect
        return redirect()->route('company.home')->with('success', 'Vaša praksa je uspešno kreirana');
    }

    public function assignTag(Request $request)
    {
        $internship = Internship::orderBy('created_at','desc')->first();
        $checkbox_list = $request->input('check_list');

        $count = count($checkbox_list);
        if ($count === 0)
            return;
        foreach ($checkbox_list as $chckbox)
            $internship->tags()->attach($chckbox);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $internship = Internship::find($id);
        return view('internship.show', compact('internship'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $internship = Internship::find($id);
        return view('internship.edit', compact('internship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $internship = Internship::find($request->id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'maximum_number' => 'required',
            'end' => 'required',
            'address' => 'required',
            'work_hours' => 'required',
        ]);

        $internship->title = $request->title;
        $internship->description = $request->description;
        $internship->duration = $request->duration;
        $internship->maximum_number = $request->maximum_number;
        $internship->end = $request->end;
        $internship->address = $request->address;
        $internship->work_hours= $request->work_hours;

        $internship->save();

        return redirect()->route('company.home')->with('success', 'Vaša praksa je izmenjena');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
