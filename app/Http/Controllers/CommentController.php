<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->content_comment
        ]);
    }
}
