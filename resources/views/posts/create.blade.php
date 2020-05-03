@extends('layouts.app')

@section('content')
  <div class="col-md-6">
    <form action="/posts" enctype="multipart/form-data" method="post">
      @csrf
      <div class="form-group">
        <label for="desc">Description: </label>
        <input type="text" id="desc" class="form-control @error('desc') is-invalid @enderror" name="desc">
      </div>
      @error('desc')
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
      @enderror
      <div class="form-group">
        <label for="upload">Upload file: </label>
        <input type="file" id="upload" class="form-control-file @error('upload') is-invalid @enderror" name="upload">
      </div>
      @error('upload')
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
      @enderror
      <input type="submit" class="btn btn-primary" value="Add post">
    </form>
  </div>
@endsection