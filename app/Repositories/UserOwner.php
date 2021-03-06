<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

trait UserOwner {

  public function getCurrentUser()
  {
    return User::findOrFail(Auth::id());
  }
}