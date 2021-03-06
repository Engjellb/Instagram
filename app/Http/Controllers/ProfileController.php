<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidation;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\UserRepositoryInteface;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    private $profileRepository;
    private $userRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository,
                                UserRepositoryInteface $userRepository)
    {
      $this->middleware('auth');
      $this->profileRepository = $profileRepository;
      $this->userRepository = $userRepository;
    }

    public function index($userId) {

      $userPosts = $this->userRepository->getUserPosts($userId);
      $user = $this->userRepository->getUser($userId);
      $profile = $this->userRepository->getUserProfile($userId);

      $data = [];

      $data['posts'] = $userPosts;

      $data['profile'] = $profile;

      $data['follows'] = $this->userRepository->getCurrentUser() ? $this->userRepository->userContainsFollow($userId) : false;

      $data['countPosts'] = $userPosts->count();

      $data['following'] = $this->userRepository->getUserFollowing($userId)->count();

      $data['followers'] = $this->profileRepository->getProfileFollowers($userId)->count();

      return view('profiles.index', compact(['data', 'user', 'profile']));
    }

    public function edit($userId) {
      
      $userProfile = $this->userRepository->getUserProfile($userId);
      $user = $this->userRepository->getUser($userId);

      $this->authorize('update', $userProfile);

      return view('profiles.edit', ['user' => $user, 'userProfile' => $userProfile]);
    }

    public function update(ProfileValidation $request, $userId) {

      $profileData = [
        'description' => $request->description,
        'title' => $request->title,
        'url' => $request->url,
        'image' => $request->image
      ];
      
      $userProfile = $this->userRepository->getUserProfile($userId);

      $this->authorize('update', $userProfile);

      if($request->hasFile('image')) {
          $imagePath = $request->file('image')->store('profiles', 'public');
          $image = Image::make(public_path('storage/'.$imagePath))->fit(500,500);
          $image->save();
      }

      if($this->profileRepository->update($profileData))
      {
        return redirect()->route('profile.index', $userId);
      }
    }
}
