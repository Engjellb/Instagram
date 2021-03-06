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

    public function store(Request $request) 
    {
      $imagePath = $request->file('upload')->store('images', 'public');
      $image = Image::make(public_path('storage/'.$imagePath))->fit(800,800);
      $image->save();
      
      $array = [
        'content' => $request->desc,
        'image' => $imagePath,
      ];

      $this->postRepository->store($array);
      $userId = $this->userRepository->getCurrentUserId();

      return redirect()->route('profile.index', $userId);
    }

    public function show($id) 
    {
        $post = $this->postRepository->getPost($id);
        $postUser = $this->postRepository->getPostUser($id);
        $postLikes = $this->postRepository->getPostLikes($id);
        
        return view('posts.show', ['post' => $post, 'postUser' => $postUser, 'postLikes' => $postLikes]);
    }
}
