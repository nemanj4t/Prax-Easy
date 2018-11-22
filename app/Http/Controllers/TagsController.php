<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Internship;

class TagsController extends Controller
{
    //

    public function index(Tag $tag)
    {
        $internships = $tag->internships;

        return view('home', compact('internships'));
       // return $tag;
    }
}
