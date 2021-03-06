<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInteface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $userRepository;
    private $postRepository;

    public function __construct(UserRepositoryInteface $userRepository,
                                PostRepositoryInterface $postRepository)
    {
        // $this->middleware(['auth']);
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profilesUserId = $this->userRepository->userPluckFollowing();
        $posts = $this->postRepository->getUserFollowingPosts($profilesUserId);

        return view('home', ['posts' => $posts]);
    }

    public function test($id)
    {
      // return 'ok';
      return $this->userRepository->userContainsFollow($id);
    }
}
