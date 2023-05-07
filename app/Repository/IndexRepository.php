<?php

namespace App\Repository;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Date;

class IndexRepository implements IndexRepositoryInterface
{
    public function index()
    {
        $posts = Post::all();
        return view('dashboard.index', compact('posts'));
    }

    public function postStore($request)
    {
        try {

            $image = uploadImagePost($request->file('image'));
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $image;
            $post->author = auth()->user()->name;
            $post->date = date('y-m-d');
            $post->save();
            return back();

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function commentStore($request)
    {
        try {

            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->date = date('y-m-d');
            $comment->post_id = $request->post_id;
            $comment->user_id = auth()->user()->id;
            $comment->save();
            return back();

        } catch (\Exception $e) {
            return back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
