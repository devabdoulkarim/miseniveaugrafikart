@extends('base')

@section('title', 'Mon Blog')

@section('content')

    {{-- Hero --}}
    <section class="relative overflow-hidden rounded-3xl bg-linear-to-br from-indigo-600 via-indigo-700 to-violet-800 text-white mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 lg:min-h-95">

            {{-- Colonne gauche : texte + stats --}}
            <div class="relative z-10 flex flex-col justify-center px-10 py-14">
                <p class="text-indigo-300 text-sm font-semibold tracking-widest uppercase mb-2">Bienvenue</p>
                <h1 class="text-5xl font-bold tracking-tight mb-3">Mon Blog</h1>
                <p class="text-indigo-200 text-lg mb-8">Découvrez nos derniers articles et actualités.</p>
                <div class="flex gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $stats['posts'] }}</div>
                        <div class="text-indigo-300 text-sm mt-1">Articles</div>
                    </div>
                    <div class="w-px bg-indigo-500/50"></div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $stats['categories'] }}</div>
                        <div class="text-indigo-300 text-sm mt-1">Catégories</div>
                    </div>
                    <div class="w-px bg-indigo-500/50"></div>
                    <div class="text-center">
                        <div class="text-4xl font-bold">{{ $stats['tags'] }}</div>
                        <div class="text-indigo-300 text-sm mt-1">Tags</div>
                    </div>
                </div>
            </div>

            {{-- Colonne droite : slider d'images --}}
            <div class="hidden lg:block relative">
                {{-- Fondu côté gauche pour fusionner avec le dégradé --}}
                <div class="absolute inset-y-0 left-0 w-20 z-10 bg-linear-to-r from-indigo-700 to-transparent pointer-events-none"></div>

                <div id="heroCarousel" class="carousel slide absolute inset-0" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner h-full">
                        <div class="carousel-item active h-full">
                            <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&q=80"
                                 alt="Écriture" class="w-full h-full object-cover">
                        </div>
                        <div class="carousel-item h-full">
                            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80"
                                 alt="Laptop et café" class="w-full h-full object-cover">
                        </div>
                        <div class="carousel-item h-full">
                            <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=800&q=80"
                                 alt="Livres et café" class="w-full h-full object-cover">
                        </div>
                        <div class="carousel-item h-full">
                            <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=800&q=80"
                                 alt="Bibliothèque" class="w-full h-full object-cover">
                        </div>
                        <div class="carousel-item h-full">
                            <img src="https://images.unsplash.com/photo-1432821596592-e2c18b78144f?w=800&q=80"
                                 alt="Rédaction créative" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="carousel-indicators mb-2">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cercles décoratifs --}}
        <div class="absolute -top-12 -left-12 w-72 h-72 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-20 left-20 w-96 h-96 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 bg-white/3 rounded-full pointer-events-none"></div>
    </section>

    {{-- Filtres catégories --}}
    <div class="flex flex-wrap items-center gap-2 mb-8">
        <span class="text-sm text-gray-500 font-medium mr-2">Filtrer :</span>
        <a href="{{ route('blog.index') }}"
            class="px-4 py-1.5 rounded-full text-sm font-medium border transition-colors
                   {{ !request('category') ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:border-indigo-400 hover:text-indigo-600' }}">
            Tous
            <span class="ml-1 {{ !request('category') ? 'text-indigo-200' : 'text-gray-400' }}">{{ $stats['posts'] }}</span>
        </a>
        @foreach ($categories as $cat)
            <a href="{{ route('blog.index', ['category' => $cat->id]) }}"
                class="px-4 py-1.5 rounded-full text-sm font-medium border transition-colors
                       {{ request('category') == $cat->id ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm' : 'bg-white text-gray-600 border-gray-200 hover:border-indigo-400 hover:text-indigo-600' }}">
                {{ $cat->name }}
                <span class="ml-1 {{ request('category') == $cat->id ? 'text-indigo-200' : 'text-gray-400' }}">{{ $cat->posts_count }}</span>
            </a>
        @endforeach

        @auth
            <a href="{{ route('admin.posts.create') }}"
                class="ml-auto flex items-center gap-2 px-4 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full text-sm font-medium transition-colors shadow-sm">
                <i class="fa-solid fa-plus text-xs"></i> Nouvel article
            </a>
        @endauth
    </div>

    {{-- Grille d'articles --}}
    @if ($posts->isEmpty())
        <div class="text-center py-24 bg-white rounded-3xl border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-newspaper text-indigo-300 text-2xl"></i>
            </div>
            <p class="text-gray-500 font-medium">Aucun article dans cette catégorie.</p>
            <a href="{{ route('blog.index') }}" class="mt-3 inline-block text-indigo-600 hover:underline text-sm">
                Voir tous les articles
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article class="group bg-white rounded-2xl border border-gray-100 hover:shadow-lg overflow-hidden flex flex-col transition-all duration-200">

                    {{-- Image --}}
                    <a href="{{ route('blog.show', $post->slug) }}" class="block overflow-hidden h-52 shrink-0">
                        @if ($post->image)
                            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-linear-to-br from-indigo-50 to-violet-100 flex items-center justify-center">
                                <i class="fa-solid fa-image text-indigo-200 text-4xl"></i>
                            </div>
                        @endif
                    </a>

                    {{-- Contenu --}}
                    <div class="p-6 flex flex-col flex-1 gap-3">

                        {{-- Badges --}}
                        <div class="flex flex-wrap gap-1.5">
                            @if ($post->category)
                                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full uppercase tracking-wide">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                            @foreach ($post->tags as $tag)
                                <span class="px-2.5 py-0.5 bg-slate-100 text-slate-500 text-xs rounded-full">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Titre + extrait --}}
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-gray-900 leading-snug group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                                {{ Str::limit($post->content, 110) }}
                            </p>
                        </div>

                        {{-- Footer card --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-400">
                                <i class="fa-regular fa-calendar mr-1"></i>
                                {{ $post->created_at->translatedFormat('d M Y') }}
                            </span>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-colors">
                                    Lire
                                </a>
                                @auth
                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="p-1.5 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                                        <i class="fa-solid fa-pencil text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Supprimer cet article ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Supprimer">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $posts->links() }}
        </div>
    @endif

    {{-- Tags cloud --}}
    @if ($tags->isNotEmpty())
        <div class="mt-12 bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4">Tags populaires</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($tags->sortByDesc('posts_count') as $tag)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 hover:bg-indigo-50 text-slate-600 hover:text-indigo-600 border border-slate-200 hover:border-indigo-300 rounded-full text-sm transition-colors cursor-default">
                        <i class="fa-solid fa-hashtag text-xs opacity-60"></i>
                        {{ $tag->name }}
                        <span class="text-xs bg-slate-200 text-slate-500 rounded-full px-1.5 py-0.5">{{ $tag->posts_count }}</span>
                    </span>
                @endforeach
            </div>
        </div>
    @endif

@endsection
