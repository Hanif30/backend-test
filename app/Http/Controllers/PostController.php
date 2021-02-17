<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index ()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function show (Request $request, $post)
    {
        $post = Post::show($post)->get();

        return response()->json($post);
    }

    public function top ()
    {
        $posts = Post::numberOfComments()->get();
        $topPosts = [];
        foreach($posts as $post) {
            $topPosts[] = [
                "post_id" => $post->id,
                "post_title" => $post->title,
                "post_body" => $post->body,
                "total_number_of_comments" => $post->comment_count,
            ];
        }

        return response()->json($topPosts);
    }
}
