@extends('layouts.app')

@section('content')
<div class="content">
    @foreach ($userProfiles as $userProfile)
      @foreach($userProfile->posts as $post)
        <div>
          <div>
            <span style="position: relative;right: 148px;"><a href="{{ route('profile.index', $userProfile->id) }}">{{ $userProfile->username }}</a></span>
          </div>
          <div>
            <a href="{{ route('posts.show', $post->id) }}"><img src="/storage/{{ $post->image }}" alt="" style="width: 30%"></a>
          </div>
          <div style="margin-bottom: 100px">
            <open-modal post-id="{{ $post->id }}" 
              count-likes="{{ $post->likes->count() > 0 ? $post->likes->count() : 0 }}"
              count-comments="{{ $post->comments->count() > 0 ? $post->comments->count() : 0}}"></open-modal>
          </div>    
        </div>
      @endforeach  
    @endforeach
</div>
@endsection