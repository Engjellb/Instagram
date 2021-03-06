@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <img src="/storage/{{ $post->image }}" width="100%" alt="">
        </div>
        <div class="col-md-4">
            <div class="row d-flex flex-column">
                <div class="d-flex align-items-center">
                    <img src="{{ $post->user->profile->profileImage() }}"
                         class="rounded-circle pr-2" style="max-width: 50px" alt="">
                    <a href="{{ route('profile.index', $postUser->id) }}"><h4 class="font-weight-bold pr-2">
                        {{ $postUser->username }}</h4></a>
                </div>
                <div class="mt-4">
                    <a href="{{ route('profile.index', $postUser->id) }}"><span class="font-weight-bold pr-2">
                        {{ $postUser->username }}</span></a>
                    <span>{{ $post->content }}</span><br>
                    <div style="cursor: pointer; margin-top: 10px; display: inline-block">
                        <form action="{{ route('posts.likes.store', $post->id) }}" method="post">
                            @csrf
                            <like-post user-id="{{ $postUser->id }}" post-id="{{ $post->id }}"></like-post>
                        </form>
                    </div>
                    <span style="margin-left: 8px">
                        <span>{{ $postLikes->count() }}</span>
                    </span>
                    <div style="margin-top: 30px;">
                        <span>Add a comment</span>
                    </div>
                    <div>
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
                            @csrf

                            <input type="text" style="width: 70%" name="content_comment">
                            <input type="submit" value="Add" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
