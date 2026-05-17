<?php

namespace App\Http\Controllers;

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
        // User::create([
        //     'name' => 'Toure dev',
        //     'email' => 'root@gmail.com',
        //     'password' => Hash::make(1234),
        // ]);

        // $post = new Post();
        // $post->title = 'Mon dernier Titre';
        // $post->slug = 'mon-dernier-article';
        // $post->content = 'Mon Contenu dernier jkdcsjkcjsckbjk';
        // $post->save();
        // return $post;

        // $posts = Post::with('category')->get();
        // foreach ($posts as $post) {

        //     $category = $post->category?->name;
        // }
        // LIAISONS ENTRE UNE POST ET UNE CATEGORY
        // $post = Post::find(3);
        // $post->category_id = 1;
        // $post->save();

        // $post = Post::find(2);
        // $post->tags()->createMany([
        //     ['name' => 'Tag 1'],
        //     ['name' => 'Tag 2'],
        //     ['name' => 'Tag 3']
        // ]);

        $categoryId = request()->integer('category');

        $posts = Post::with('tags', 'category')
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();

        $stats = [
            'posts' => Post::count(),
            'categories' => $categories->count(),
            'tags' => $tags->count(),
        ];

        return view('blog.index', compact('posts', 'categories', 'tags', 'stats'));
    }

    public function create()
    {
        $post = new Post;
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        return view('blog.create', compact('post', 'categories', 'tags'));
    }

    public function store(FormPostRequest $request)
    {
        $post = new Post;
        // LA FONCTION extracteData() EST JUSTE DANS LA METHODE PRIVATE JUSTE EN BAS
        $post = Post::create($this->extracteData($post, $request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('blog.index')->with('success', "L'article a Bien été sauvegarder");
    }

    public function edit(Post $post)
    {
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        return view('blog.edit', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    public function update(Post $post, FormPostRequest $request)
    {

        // CETTE METHODE A POUR AVANTAGE D'ÊTRE UTILSER DANS STORE & UPADTE
        $post->update($this->extracteData($post, $request));

        // Synchronisation des tags
        $post->tags()->sync($request->validated('tags') ?? []);

        return redirect()
            ->route('blog.index')
            ->with('success', "L'article a bien été modifié");
    }

    private function extracteData(Post $post, FormRequest $request): array
    {
        $data = $request->validated();
        // Récupération du fichier uploadé
        $image = $request->file('image');

        // Vérifie si une image a été envoyée
        if ($image === null || $image->getError()) {
            return $data;
        }

        // verifier si au nivaeu de l'article, c'est meme image alors il la supprime
        if ($post->image) {

            Storage::disk('public')->delete($post->image);
        }

        // Stockage de l'image
        $data['image'] = $image->store('blog', 'public');

        return $data;
    }

    public function show(string $slug)
    {
        $post = Post::with('category', 'tags')->where('slug', $slug)->firstOrFail();
        $remainingpost = Post::with('category')->where('id', '!=', $post->id)->latest()->take(3)->get();

        return view('blog.show', compact('post', 'remainingpost'));

        // $post = Post::findOrFail($id);

        // if ($post->slug !== $slug) {
        //     return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        // }

        // return view('blog.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {

        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Post supprimé');
    }
}
