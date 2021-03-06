<?php

namespace App\Repositories;

use App\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

  use UserOwner;

  public function __construct(Post $post)
  {
    parent::__construct($post);
  }

  public function store($array)
  {
    return $this->getCurrentUser()->posts()->create($array);
  }

  public function getPost($id)
  {
    return $this->findById($id);
  }

  public function getPostUser($postId)
  {
    $post = $this->findById($postId);

    return $post->user;
  }

  public function getPostUserProfile($postId)
  {
    return $this->getPostUser($postId)->profile;
  }

  public function getPostLikes($postId)
  {
    $post = $this->findById($postId);

    return $post->likes;
  }

  public function getPostComments($postId)
  {
    $post = $this->findById($postId);

    return $post->comments;
  }

  public function getUserFollowingPosts($profileUserId)
  {
    return $this->model->whereIn('user_id', $profileUserId)->orderBy('created_at', 'DESC')->get();
  }
}
