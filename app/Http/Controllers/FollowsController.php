<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInteface;

class FollowsController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInteface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function store($userId)
    {
        $userProfile = $this->userRepository->getUserProfile($userId);

        return $this->userRepository->userToggleFollowing($userProfile);
    }
}
