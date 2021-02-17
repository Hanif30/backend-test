<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index ()
    {
        $comments = Comment::all();

        return response()->json($comments);
    }

    public function filter (Request $request)
    {
        return response()->json("hit");
    }
}
