<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $posts = Post::with('category')->paginate(6);
        $likedPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(6);
        return view('post.index', compact('posts', 'likedPosts', 'categories'));
    }
}
