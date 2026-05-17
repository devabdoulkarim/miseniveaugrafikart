<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $post = new Post;
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    public function store(FormPostRequest $request)
    {
        $post = Post::create($this->extractData(new Post, $request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('admin.posts.index')
            ->with('success', "L'article a été publié avec succès.");
    }

    public function edit(Post $post)
    {
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($this->extractData($post, $request));
        $post->tags()->sync($request->validated('tags') ?? []);

        return redirect()->route('admin.posts.index')
            ->with('success', "L'article a été modifié avec succès.");
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', "L'article a été supprimé.");
    }

    private function extractData(Post $post, FormRequest $request): array
    {
        $data = $request->validated();
        $image = $request->file('image');

        if ($image === null || $image->getError()) {
            return $data;
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $data['image'] = $image->store('blog', 'public');

        return $data;
    }
}
