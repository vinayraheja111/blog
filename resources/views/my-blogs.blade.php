@extends('layouts.app')
@section('title','Blog | Create Blog')

@section('content')

<div class="container">
	@if(Session::has('success'))
         <div class="alert alert-success mt-5">{{ Session::get('success') }}</div>
     @endif
<table class="table table-dark mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	@if(count($blogs) > 0)
  	  @foreach($blogs as $index => $blog)
    <tr>
      <th scope="row">{{ $index + 1}}</th>
      <td><img src="{{ asset('assets/blog/'.$blog->image) }}" height="40px" width="40px"></td>
      <td>{{ $blog->title }}</td>
      <td>{{ $blog->description }}</td>
      <td><a href="{{ url('edit-blog/'.$blog->id ) }}"><button class="btn btn-info">Edit</button>&nbsp;<a href="{{ url('delete-blog/'.$blog->id) }}"><button class="btn btn-danger">Delete</button></a></td>
    </tr>
    @endforeach
    @else
    <tr><td>No Blog uploaded.</td></tr>
    @endif
  </tbody>
</table>
</div>

@endsection