<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidation;
use Illuminate\Http\Request;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInteface;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    private $postRepository;
    private $userRepository;

    public function __construct(PostRepositoryInterface $postRepository, 
                                UserRepositoryInteface $userRepository)
    {
      $this->middleware('auth');
      $this->postRepository = $postRepository;
      $this->userRepository = $userRepository;
    }

    public function create() {
      return view('posts.create');
    }

    public function store(ProfileValidation $request) 
    {
      $imagePath = $request->file('upload')->store('images', 'public');
      $image = Image::make(public_path('storage/'.$imagePath))->fit(800,800);
      $image->save();

      $this->postRepository->store($request->all());
      $user = $this->userRepository->getUserId();

      return redirect()->route('profile.index', $user);
    }

    public function show($id) 
    {
        $post = $this->postRepository->getPost($id);
        $user = $this->userRepository->getUserId();

        return view('posts.show', ['post' => $post, 'user' => $user]);
    }
}
