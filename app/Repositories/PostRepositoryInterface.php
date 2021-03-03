<?php

namespace App\Repositories;

use App\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface {

  public function store(Array $array);

  public function getPost($id);
}