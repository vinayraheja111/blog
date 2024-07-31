@extends('layouts.app')
@section('title','Blog | Create Blog')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
      	
        <div class="card">
          <div class="card-header bg-dark text-white">
            Create a New Blog Post
          </div>
          <div class="card-body">
            <form method="post" action="{{ asset('save-blog') }}" enctype="multipart/form-data">
            	@csrf
              <div class="mb-3">
                <label for="title" class="form-label">Blog Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter blog title" name="title" value="{{ old('title') }}">
                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="5" placeholder="Write your blog content here..." name="description" value="{{ old('description') }}"></textarea>
                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="image" name="image">
                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection