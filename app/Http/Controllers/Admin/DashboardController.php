<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

        $chartPostsByMonth = Post::select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as sort_key"),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month', 'sort_key')
            ->orderBy('sort_key')
            ->get();

        $chartPostsByCategory = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->get();

        $chartTags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentPosts',
            'categories',
            'chartPostsByMonth',
            'chartPostsByCategory',
            'chartTags'
        ));
    }
}
