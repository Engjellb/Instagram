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
    return $this->findById(Auth::id())->id;
  }
}