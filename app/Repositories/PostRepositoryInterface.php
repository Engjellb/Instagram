<?php

namespace App\Repositories;

use App\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface {

  public function store(Array $array);

  public function getPost($id);

  public function getPostUser($postId);

  public function getPostUserProfile($postId);

  public function getPostLikes($postId);

  public function getPostComments($postId);

  public function getUserFollowingPosts($profileUserId);
}