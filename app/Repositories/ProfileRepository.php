<?php

namespace App\Repositories;

use App\Profile;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface {
  
  use UserOwner;

  public function __construct(Profile $profile)
  {
    parent::__construct($profile);
  }

  public function update($array)
  {
    return $this->getCurrentUser()->profile()->update($array);
  }

  public function getProfileFollowers($userId)
  {
    $profile = $this->findById($userId);

    return $profile->followers;
  }
}