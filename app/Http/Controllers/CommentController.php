<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Company;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function store(Request $request)
    {
        if($request->input('comment') === null)
            return redirect()->back();

        $comment = new Comment;
        $comment->content = $request->input('comment');
        $comment->user_id = $request->input('user_id');
        $comment->company_id = $request->input('company_id');

        $comment->save();


        return redirect()->back();
    }
}
