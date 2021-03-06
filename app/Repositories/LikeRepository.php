<?php

namespace App\Repositories;

use App\Like;

class LikeRepository extends BaseRepository implements LikeRepositoryInterface{
  
  use UserOwner;

  public function __construct(Like $like)
  {
    parent::__construct($like);
  }

  public function store($array)
  {
    return $this->getCurrentUser()->likes()->create($array);
  }
}