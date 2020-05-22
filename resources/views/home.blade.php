@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex flex-column align-content-center">
            @foreach($posts as $post)
            <div class="col-md-8">
                <div>
                    <img src="{{ $post->user->profile->profileImage() }}"
                         width="40px" class="rounded-circle" alt="">
                    <a href="/profiles/{{ $post->user->id }}"><span>{{ $post->user->username }}</span></a>
                </div>
                <img src="/storage/{{ $post->image }}" width="55%" class="pt-1" alt="">
            </div>
            @endforeach
    </div>
</div>
@endsection
