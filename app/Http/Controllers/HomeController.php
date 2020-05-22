<?php

namespace App\Http\Controllers;

use App\Post;
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
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profiles = Auth::user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $profiles)->orderBy('created_at', 'DESC')->get();
        return view('home', ['posts' => $posts]);
    }
}
