<?php

namespace App\Repositories;

interface UserRepositoryInteface {
  
  public function getCurrentUserId();

  public function getUser($id);

  public function getCurrentUser();

  public function userContainsFollow($userId);

  public function userToggleFollowing($userProfile);

  public function userPluckFollowing();

  public function getUserProfile($userId);

  public function getUserPosts($userId);

  public function getUserFollowing($userId);
}