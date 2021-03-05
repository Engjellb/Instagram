<?php

namespace App\Repositories;

interface UserRepositoryInteface {
  
  public function getUserId();

  public function getUser($id);

  public function getCurrentUser();

  public function userContainsFollow($userId);

  public function userToggleFollowing($userProfile);

  public function getUserProfile($userId);

  public function getUserPosts($userId);

  public function getUserFollowing($userId);
}