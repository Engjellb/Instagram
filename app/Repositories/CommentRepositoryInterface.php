<?php

namespace App\Repositories;

interface CommentRepositoryInterface {

  public function store($array);

  public function getUserComment($comment);
}