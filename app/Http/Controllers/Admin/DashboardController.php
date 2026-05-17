<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts' => Post::count(),
            'categories' => Category::count(),
            'tags' => Tag::count(),
            'users' => User::count(),
        ];

        $recentPosts = Post::with('category')->latest()->take(5)->get();
        $categories = Category::withCount('posts')->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'categories'));
    }
}
