@extends('dashboard.layouts.master')
@section('title', 'Comment Trash')
@section('content')
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Comment</th>
            <th scope="col">Author</th>
            <th scope="col">Post Title</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $index=>$comment)
            <tr>
                <th scope="row">{{$index}}</th>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->post->author}}</td>
                <td>{{$comment->post->title}}</td>
                <td>
                    <a href="{{route('comments.restore', $comment->id)}}" class="btn btn-info btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                        </svg>
                    </a>
                    <a href="{{route('comments.delete', $comment->id)}}" class="btn btn-sm btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
