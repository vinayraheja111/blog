@extends('layouts.app')
@section('title','Blog | Dashboard')

@section('content')

 <div class="container mt-4">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                @if(count($blogs) > 0)
                    
                    <div class="row">
                        @foreach($blogs as $blog)
                        <div class="col-4">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ \Carbon\Carbon::parse($blog->post_date)->format('F j, Y')}}</div>
                                    <h2 class="card-title h4">{{ $blog->title }}</h2>
                                    <p class="card-text">{{ $blog->description }}</p>
                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                </div>
                            </div>
                        </div>
                            @endforeach 
                    </div>
                  
                    @else
                      <h5>No Blogs Uploaded yet.!!</h5>
                    @endif

                </div>
                <!-- Side widgets-->
            </div>
        </div>
@endsection