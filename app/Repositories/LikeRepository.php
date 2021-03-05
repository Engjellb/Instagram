<?php

namespace App\Repositories;

use App\Like;
use App\Post;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface{
  
  use UserOwner;

  public function __construct(Like $like)
  {
    parent::__construct($like);
  }

  public function store($array)
  {
    return $this->getUser()->likes()->create($array);
  }
}