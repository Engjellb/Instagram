<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

  use UserOwner;

  public function __construct(Comment $comment)
  {
    parent::__construct($comment);
  }

  public function store($array)
  {
    return $this->getCurrentUser()->comments()->create($array);
  }

  public function getUserComment($comment)
  {
    return $comment->user;
  }
}
