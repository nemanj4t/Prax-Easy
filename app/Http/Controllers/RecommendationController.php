<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recommendation;

class RecommendationController extends Controller
{
    //

    public function store(Request $request)
    {
        $recommendation = new Recommendation;
        $recommendation->student_id = $request->input('student_id');
        $recommendation->company_id = $request->input('company_id');

        $recommendation->save();

        return redirect()->back();
    }
}
