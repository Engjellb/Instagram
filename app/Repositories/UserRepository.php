<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInteface {

  public function __construct(User $user)
  {
    parent::__construct($user);
  }

  public function getUserId()
  {
    return 1;
  }

  public function getUser($id)
  {
    return $this->findById($id);
  }

  public function getCurrentUser()
  {
    return Auth::user();
  }

  public function userContainsFollow($userId)
  {
    return $this->findById(Auth::id())->following()->contains($userId);
  }

  public function userToggleFollowing($userProfile)
  {
    return $this->findById(Auth::id())->following()->toggle($userProfile);
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