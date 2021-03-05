<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

trait UserOwner {

  public function getUser()
  {
    return User::findOrFail(2);
  }
}