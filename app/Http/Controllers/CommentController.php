<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;
    private $postRepository;

    public function __construct(CommentRepositoryInterface $commentRepository, 
                                PostRepositoryInterface $postRepository)
    {
        // $this->middleware('auth');
      $this->commentRepository = $commentRepository;
      $this->postRepository = $postRepository;
    }

    public function index($id)
    { 
      $postComments = $this->postRepository->getPostComments($id);
      $users = [];
      
      foreach ($postComments as $comment)
        $users[] = ['user' => $this->commentRepository->getUserComment($comment), 'content' => $comment->content]; 
      
      return $users;
    }

    public function store(Request $request, $postId)
    {
        $array = [
          'post_id' => $postId,
          'content' => $request->content
        ];

        return $this->commentRepository->store($array);
    }
}
