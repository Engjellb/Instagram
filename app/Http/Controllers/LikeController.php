<?php

namespace App\Http\Controllers;

use App\Repositories\LikeRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInteface;

class LikeController extends Controller
{
    private $likeRepository;
    private $userRepository;
    private $postRepository;

    public function __construct(LikeRepositoryInterface $likeRepository,
                                UserRepositoryInteface $userRepository,
                                PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth');
        $this->likeRepository = $likeRepository;
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    public function index($id)
    {
      $postLikes = $this->postRepository->getPostLikes($id);

      $users = [];
      foreach ($postLikes as $postLike) {
        $users[] = $this->userRepository->getUser($postLike->user_id);
      }

      $profiles = [];
      foreach ($users as $user) {
        $profiles[] = $this->userRepository->getUserProfile($user->id);
      }

      return response()->json(['title' => 'Likes', 
                          'users' => $users, 'profiles' => $profiles, 'likesCount' => $postLikes->count()]);
    }

    public function store($id)
    {
        $array = [
          'post_id' => $id
        ];

        if($this->likeRepository->store($array))
        {
          return redirect()->back();
        }
    }
}
