<?php

namespace App\Repositories;

use App\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface {

  use UserOwner;

  public function __construct(Post $post)
  {
    parent::__construct($post);
  }

  public function store($array)
  {
    return $this->getUser()->posts()->create($array);
  }

  public function getPost($id)
  {
    return $this->findById($id);
  }
}