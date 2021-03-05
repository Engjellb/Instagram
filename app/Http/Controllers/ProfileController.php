<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\UserRepositoryInteface;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    private $profileRepository;
    private $userRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository,
                                UserRepositoryInteface $userRepository)
    {
      $this->profileRepository = $profileRepository;
      $this->userRepository = $userRepository;
    }

    public function index($userId) {

      $userPosts = $this->userRepository->getUserPosts($userId);
      $user = $this->userRepository->getUser($userId);

      $data = [];

      $data['posts'] = $userPosts;

      $data['profile'] = $this->userRepository->getUserProfile($userId);

      $data['follows'] = $this->userRepository->getCurrentUser() ? $this->userRepository->userContainsFollow($userId) : false;

      $data['countPosts'] = $userPosts->count();

      $data['following'] = $this->userRepository->getUserFollowing($userId)->count();

      $data['followers'] = $this->profileRepository->getProfileFollowers($userId)->count();

      return view('profiles.index', compact(['data', 'user']));
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', ['user' => $user]);
    }

    public function update($userId, Request $request) {
      
      $userProfile = $this->userRepository->getUserProfile($userId);

      $this->authorize('update', $userProfile);

        // if($request->hasFile('upload')) {
        //     $imagePath = $request->file('upload')->store('profiles', 'public');
        //     $image = Image::make(public_path('storage/'.$imagePath))->fit(500,500);
        //     $image->save();
        // }
        return $this->profileRepository->update($request->all());

        // $user->profile()->update([
        //     'title' => $request->input('title'),
        //     'description' => $request->input('desc'),
        //     'url' => $request->input('url'),
        //     'image' => $imagePath ?? $user->profile->image
        // ]);

        // return redirect()->route('profile.index', $user->id);
    }
}
