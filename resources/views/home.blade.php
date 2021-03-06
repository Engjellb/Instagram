@extends('layouts.app')

@section('content')
@inject('postService', 'App\Repositories\PostRepositoryInterface')

<div class="container">
  <div class="row d-flex flex-column align-content-center">
    @foreach($posts as $post)
    <div class="col-md-8" style="margin-bottom: 100px">
      <div>
        <img src="{{ $postService->getPostUserProfile($post->id)->profileImage() }}"
              width="40px" class="rounded-circle" alt="">
        <a href="/profiles/{{ $postService->getPostUser($post->id)->id }}"><span>{{ $postService->getPostUser($post->id)->username }}</span></a>
      </div>
      <a href="{{ route('posts.show', $post->id) }}">
        <img src="/storage/{{ $post->image }}" width="55%" class="pt-1" alt="">
      </a>
      <open-modal post-id="{{ $post->id }}" 
        count-likes="{{ $postService->getPostLikes($post->id)->count() > 0 ? $postService->getPostLikes($post->id)->count() : 0 }}"
        count-comments="{{ $postService->getPostComments($post->id)->count() > 0 ? $postService->getPostComments($post->id)->count() : 0}}"></open-modal>
    </div>
    @endforeach
  </div>
</div>
@endsection
