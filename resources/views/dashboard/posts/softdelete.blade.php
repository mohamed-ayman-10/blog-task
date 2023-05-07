@extends('dashboard.layouts.master')
@section('title', 'Post Trash')
@section('content')
    <div class="row">
        @forelse($posts as $post)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h4>{{$post->author}}</h4>
                            <h4>{{$post->title}}</h4>
                            <p>{{$post->created_at->diffForHumans()}}</p>
                        </div>
                        <div>
                                <a href="{{route('posts.restore', $post->id)}}" class="btn btn-info btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                        <path
                                            d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                    </svg>
                                </a>
                                <a href="{{route('posts.delete', $post->id)}}" class="btn btn-sm btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                        </div>
                    </div>
                    <img src="images/posts/{{$post->image}}" class="card-img-top" alt="vvv">
                    <div class="card-body">
                        {{$post->content}}
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Not Posts</p>
        @endforelse
    </div>
@endsection
