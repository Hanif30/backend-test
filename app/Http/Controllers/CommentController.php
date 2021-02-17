<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index ()
    {
        $comments = Comment::all();

        return response()->json($comments);
    }

    public function filter (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id.*' => 'nullable|integer|distinct',
            'comment_id.*' => 'nullable|integer|distinct',
            'name.*' => 'nullable|string|distinct',
            'email.*' => 'nullable|email|distinct',
            'body.*' => 'nullable|string|distinct',
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()->all()]);
        }

        $filterComments = Comment::id($request->comment_id)
            ->post($request->post_id)
            ->name($request->name)
            ->email($request->email)
            ->body($request->body)
            ->get();
        
        return response()->json($filterComments);
    }
}
