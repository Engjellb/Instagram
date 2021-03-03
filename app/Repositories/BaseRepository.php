<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface {

  private $model;

  public function __construct(Model $model)
  {  
    $this->model = $model;
  }

  public function findById($id)
  {
    return $this->model->findOrFail($id);
  }
}