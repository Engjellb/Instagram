<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
      foreach ($post->likes as $like) {
        $users[] = User::find($like->user_id);
      }

      foreach ($users as $user) {
        $profiles[] = $user->profile;
      }
      
      return response()->json(['title' => 'Likes', 
                          'users' => $users, 'profiles' => $profiles, 'likesCount' => $post->likes->count()]);
    }

    public function store(Request $request, Post $post)
    {
        $user_id = Auth::id();

        Like::create([
           'user_id' => $user_id,
           'post_id' => $post->id
        ]);
    }
}
