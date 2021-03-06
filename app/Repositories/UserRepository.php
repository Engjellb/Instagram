<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInteface {

  public function __construct(User $user)
  {
    parent::__construct($user);
  }

  public function getCurrentUserId()
  {
    return Auth::id();
  }

  public function getUser($id)
  {
    return $this->findById($id);
  }

  public function getCurrentUser()
  {
    return $this->findById(Auth::id());
  }

  public function userContainsFollow($userId)
  {
    return $this->getCurrentUser()->following->contains($userId);
  }

  public function userToggleFollowing($userProfile)
  {
    return $this->getCurrentUser()->following()->toggle($userProfile);
  }

  public function userPluckFollowing()
  {
    return $this->getCurrentUser()->following()->pluck('profiles.user_id');;
  }
 
  public function getUserProfile($userId)
  {
    $user = $this->findById($userId);
    
    return $user->profile;
  }

  public function getUserPosts($userId)
  {
    $user = $this->findById($userId);

    return $user->posts;
  }

  public function getUserFollowing($userId)
  {
    $user = $this->findById($userId);

    return $user->following;
  }
}