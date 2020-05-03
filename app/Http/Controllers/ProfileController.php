<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(User $user) {

      $posts = $user->posts;
      $profile = $user->profile;
      $follows = (Auth::user()) ? Auth::user()->following->contains($user->id) : false;
      return view('profiles.index', [
        'profile' => $profile,
         'user' => $user,
         'posts' => $posts,
          'follows' => $follows
        ]);
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', ['user' => $user]);
    }

    public function update(User $user, Request $request) {
        $this->authorize('update', $user->profile);

        if($request->hasFile('upload')) {
            $imagePath = $request->file('upload')->store('profiles', 'public');
            $image = Image::make(public_path('storage/'.$imagePath))->fit(500,500);
            $image->save();
        }

        $user->profile()->update([
            'title' => $request->input('title'),
            'description' => $request->input('desc'),
            'url' => $request->input('url'),
            'image' => $imagePath ?? $user->profile->image
        ]);

        return redirect()->route('profile.index', $user->id);
    }
}
