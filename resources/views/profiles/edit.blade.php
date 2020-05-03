@extends('layouts.app')

@section('content')
    <div class="form-group">
       <div class="row">
           <div class="col-md-6">
               <form action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data" method="post">
                   @csrf
                   @method('PUT')

                   <label for="title">Title</label>
                   <input type="text" class="form-control" name="title" id="title" value="{{ $user->profile->title }}">
                   <label for="desc">Description</label>
                   <input type="text" class="form-control" name="desc" id="desc" value="{{ $user->profile->description }}">
                   <label for="url">Url</label>
                   <input type="text" class="form-control" name="url" id="url" value="{{ $user->profile->url }}">
                   <label for="image">Image</label>
                   <input type="file" class="form-control-file" name="upload" id="image">
                   <br>
                   <input type="submit" value="Edit" class="btn btn-primary">
               </form>
           </div>
       </div>
    </div>
@endsection
