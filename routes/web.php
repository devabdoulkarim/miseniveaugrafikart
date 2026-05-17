<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
// use App\Models\Post;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use function Pest\Laravel\get;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'index'])->name('blog.index');

Route::get('/new', [PostController::class, 'create'])->name('blog.create')->middleware('auth');

Route::post('/store', [PostController::class, 'store'])->name('blog.store')->middleware('auth');

Route::get('/{post}/edit', [PostController::class, 'edit'])->name('blog.edit')->middleware('auth');

Route::patch('/{post}/edit', [PostController::class, 'update'])->name('blog.update')->middleware('auth');

Route::get('/{slug}/show', [PostController::class, 'show'])->where([
    'post' => '[0-9]+',
    'slug' => '[a-z0-9\-]+'
])->name('blog.show')->middleware('auth');

Route::get('/{post}/suprimer', [PostController::class, 'destroy'])->name('blog.delete')->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'dologin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // $post = Post::create([
    //     'title'=>'mon good personnel',
    //     'slug'=>'mon-good-personnel',
    //     'content'=>'je suis un contenu goood'
    // ]);

    // $post = new Post();
    // $post->title ='Mon deuxieme Titre';
    // $post->slug ='mon-deuxieme-article';
    // $post->content ='Mon Contenu';
    // $post->save();

    // $post = Post::all(['id','title']);
