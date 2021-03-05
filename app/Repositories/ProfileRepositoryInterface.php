<?php

namespace App\Repositories;

interface ProfileRepositoryInterface {

  public function update($array);

  public function getProfileFollowers($userd);
}