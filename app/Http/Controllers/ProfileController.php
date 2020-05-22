<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(User $user) {

      $posts = Cache::rememberForever('profile.posts.' . $user->id, function () use ($user) {
          return $user->posts;
      });
      $profile = Cache::rememberForever('profile.' . $user->id, function () use ($user) {
          return $user->profile;
      });
      $follows = (Auth::user()) ? Auth::user()->following->contains($user->id) : false;

      $countPosts = Cache::rememberForever('count.posts.' . $user->id, function () use ($user) {
              return $user->posts->count();
          });
      $following = Cache::rememberForever('count.following.' . $user->id, function () use ($user) {
          return $user->following->count();
      });
      $followers = Cache::rememberForever('count.followers.' . $user->id, function () use ($user) {
          return $user->profile->followers->count();
      });
      return view('profiles.index', [
        'profile' => $profile,
         'user' => $user,
         'posts' => $posts,
          'follows' => $follows,
          'countPosts' => $countPosts,
          'following' => $following,
          'followers' => $followers
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
