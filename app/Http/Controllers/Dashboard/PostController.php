<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function update(PostRequest $request)
    {
        try {

            $post = Post::query()->findOrFail($request->id);
            $post->content = $request->content;
            $post->title = $request->title;
            if ($request->hasFile('image')) {
//                Storage::disk('uploadImagePost')->delete($post->image);
                deleteImagePost($post->image);
                $post->image = uploadImagePost($request->image);
            }
            $post->save();
            return back();

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return back();
    }

    public function softDelete() {
        $posts = Post::onlyTrashed()->where('author', auth()->user()->name)->get();
        return view('dashboard.posts.softdelete', compact('posts'));
    }

    public function restore($id) {
        Post::withTrashed()->where('id', $id)->restore();
        return back();
    }

    public function delete($id) {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->forceDelete();
        deleteImagePost($post->image);
        return back();
    }
}
