<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Repository\IndexRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public $items;
    public function __construct(IndexRepositoryInterface $items) {
        $this->items = $items;
    }
    public function index() {
        return $this->items->index();
    }

    public function postStore(PostRequest $request) {
        return $this->items->postStore($request);
    }

    public function commentStore(CommentRequest $request) {
        return $this->items->commentStore($request);
    }

    public function logout() {
        Auth::logout();
        return back();
    }
}
