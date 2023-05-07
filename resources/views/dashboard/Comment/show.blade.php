@extends('dashboard.layouts.master')
@section('title', 'Comments')
@section('btn')
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addComment">
        Add Comment
    </button>
@endsection
@section('content')
    @forelse($comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="float-start">
                    <h3 class="card-title">{{$comment->user->name}}</h3>
                    <p>{{$comment->comment}}</p>
                </div>
                @if(auth()->user()->id == $comment->user_id)
                    <div class="float-end">
                        <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                           data-bs-target="#commentUpdate{{$comment->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                           data-bs-target="#commentDelete{{$comment->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path
                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <!-- Modal Delete Comment -->
        <div class="modal fade" id="commentDelete{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Comment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card-body"><p>are you sure delete Comment?</p></div>
                    <input type="hidden" name="id" value="{{$comment->id}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{route('comments.destroy', $comment->id)}}" class="btn btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Update Comment -->
        <div class="modal fade" id="commentUpdate{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Comment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="commentUpdate" action="{{route('comments.update')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Comment</label>
                                <input type="text" name="comment" value="{{old('comment', $comment->comment)}}"
                                       class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$comment->id}}">
                        <input type="hidden" name="post_id" value="{{$id}}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="commentUpdate">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @empty
        Not Comments
    @endforelse
@endsection
<!-- Modal Add Comment -->
<div class="modal fade" id="addComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="commentStore" action="{{route('dashboard.commentStore')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Comment</label>
                        <input type="text" name="comment" value="{{old('comment')}}" class="form-control">
                    </div>
                </div>
                <input type="hidden" name="post_id" value="{{$id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="commentStore">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

