@extends('layouts.app')

@section('content')
  <div class="row mt-5">
    <div class="col-md-5 d-flex justify-content-center">
      <img id="profile" src="{{ $user->profile->profileImage() }}"
      alt="" class="rounded-circle w-50">
    </div>
    <div class="col-md-7">
      <div class="row d-flex flex-column">
          <div class="d-flex">
              <div><h3>{{ $user->username }}</h3></div>
              <follow-user user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-user>
          </div>
          @can ('update', $user->profile)
          <a href="{{ route('profiles.edit', $user->id) }}">Edit profile</a>
          @endcan
        <div class="row ml-1 mt-2">
          <div class="pr-5"><strong class="pr-1">{{ count($posts) }}</strong>posts</div>
          <div class="pr-5"><strong class="pr-1">{{ $user->profile->followers->count() }}</strong>followers</div>
          <div class="pr-5"><strong class="pr-1">{{ $user->following->count() }}</strong>following</div>
            @can('update', $user->profile)
                <div><a href="{{ route('posts.create') }}">Add a new post</a></div>
            @endcan
        </div>
        <h4 class="pt-4">{{ $profile->title }}</h4>
        <p>{{ $profile->description }}</p>
        <a href="#"><p>{{ $profile->url }}</p></a>
      </div>
    </div>
  </div>
  <div class="row d-flex flex-wrap" id="photoRow">
    @foreach($posts as $post)
    <div class="col-md-4 pl-1">
        <a href="{{ route('posts.show', $post->id) }}">
            <img src="/storage/{{ $post->image }}" alt="" width="100%">
        </a>
    </div>
    @endforeach
  </div>
@endsection
