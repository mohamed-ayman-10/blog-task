@extends('dashboard.layouts.master')
@section('title', 'Posts')
@section('btn')
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Post
    </button>
@endsection
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
                            @if($post->author == auth()->user()->name)
                                <a href="" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                   data-bs-target="#updatePost{{$post->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                   data-bs-target="#deletePost{{$post->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
                            @endif
                            <a href="{{route('comments.show', $post->id)}}" class="btn btn-sm btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path
                                        d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <img src="images/posts/{{$post->image}}" class="card-img-top" alt="vvv">
                    <div class="card-body">
                        {{$post->content}}
                    </div>
                    <div class="card-footer">
                        <form id="commentForm" action="{{route('dashboard.commentStore')}}" method="post">
                            @csrf
                            <div class="form-control d-flex align-items-center justify-content-between gap-2">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <input type="text" name="comment" class="form-control" placeholder="Comment"
                                       value="{{old('comment')}}">
                                <button form="commentForm" type="submit" class="btn btn-sm btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-send" viewBox="0 0 16 16">
                                        <path
                                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Update Post -->
            <div class="modal fade" id="updatePost{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('posts.update')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" value="{{old('title', $post->title)}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">image</label>
                                    <input type="file" name="image" accept="image/.png,.jpg,.webp" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Content</label>
                                    <textarea class="form-control" name="content">{{old('content', $post->content)}}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Delete Post -->
            <div class="modal fade" id="deletePost{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                are you sure delete Post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{route('posts.destroy', $post->id)}}" class="btn btn-primary" >Delete</a>
                            </div>
                    </div>
                </div>
            </div>

        @empty
            <p class="text-center">Not Posts</p>
        @endforelse
    </div>
@endsection
<!-- Modal Add Post -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="postForm" action="{{route('dashboard.postStore')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">image</label>
                        <input type="file" name="image" accept="image/.png,.jpg,.webp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content">{{old('content')}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="postForm">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
