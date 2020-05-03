<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function create() {
      return view('posts.create');
    }

    public function store(Request $request) {
      // $validate = $request->validate([
      //   'desc' => 'required',
      //   'upload' => 'required'
      // ]);

      /*
      Upload file to filesystem with generated
      file name
      */
      $imagePath = $request->file('upload')->store('images', 'public');
      $image = Image::make(public_path('storage/'.$imagePath))->fit(800,800);
      $image->save();

      //insert to post table
      $post = new Post();
      $user = User::find(Auth::id());
      $post->content = $request->input('desc');
      $post->image = $imagePath;
      $user->posts()->save($post);

      return redirect()->route('profile.index', Auth::id());
    }

    public function show(Post $post) {
        return view('posts.show', ['post' => $post]);
    }
}
