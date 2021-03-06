@extends('layouts.app')

@section('content')
  <div class="row mt-5">
    <div class="col-md-5 d-flex justify-content-center">
      <img id="profile" src="{{ $profile->profileImage() }}"
      alt="" class="rounded-circle w-50">
    </div>
    <div class="col-md-7">
      <div class="row d-flex flex-column">
          <div class="d-flex">
              <div><h3>{{ $user->username }}</h3></div>
              @cannot ('update', $profile)
              <follow-user user-id="{{ $user->id }}" follows="{{ $data['follows'] }}"></follow-user>
              @endcan
          </div>
          @can ('update', $profile)
          <a href="{{ route('profiles.edit', $user->id) }}">Edit profile</a>
          @endcan
        <div class="row ml-1 mt-2">
          <div class="pr-5"><strong class="pr-1">{{ $data['countPosts'] }}</strong>posts</div>
          <div class="pr-5"><strong class="pr-1">{{ $data['followers'] }}</strong>followers</div>
          <div class="pr-5"><strong class="pr-1">{{ $data['following'] }}</strong>following</div>
            @can('update', $profile)
                <div><a href="{{ route('posts.create') }}">Add a new post</a></div>
            @endcan
        </div>
        <h4 class="pt-4">{{ $data['profile']->title }}</h4>
        <p>{{ $data['profile']->description }}</p>
        <a href="#"><p>{{ $data['profile']->url }}</p></a>
      </div>
    </div>
  </div>
  <div class="row d-flex flex-wrap" id="photoRow">
    @foreach($data['posts'] as $post)
    <div class="col-md-4 pl-1">
        <a href="{{ route('posts.show', $post->id) }}">
            <img src="/storage/{{ $post->image }}" alt="" width="100%">
        </a>
    </div>
    @endforeach
  </div>
@endsection
