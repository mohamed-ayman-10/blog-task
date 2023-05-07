<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show($id) {
        $comments = Comment::where('post_id', $id)->get();
        return view('dashboard.Comment.show', compact('comments', 'id'));
    }

    public function update(CommentRequest $request) {
        try {
            Comment::findOrFail($request->id)->update([
                'comment' => $request->comment
            ]);

            return back();

        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id) {
        Comment::destroy($id);
        return back();
    }

    public function softDelete() {
        $comments = Comment::where('user_id', auth()->user()->id)->onlyTrashed()->get();
        return view('dashboard.Comment.softdelete', compact('comments'));
    }

    public function restore($id) {
        Comment::where('id', $id)->withTrashed()->restore();
        return back();
    }

    public function delete($id) {
        Comment::where('id', $id)->forceDelete();
        return back();
    }
}
