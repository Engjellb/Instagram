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
                    <a href="{{ route('profile.index', $post->user->id) }}"><h4 class="font-weight-bold pr-2">
                        {{ $post->user->username }}</h4></a>
                </div>
                <div class="mt-4">
                    <a href="{{ route('profile.index', $post->user->id) }}"><span class="font-weight-bold pr-2">
                        {{ $post->user->username }}</span></a>
                    <span>{{ $post->content }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
