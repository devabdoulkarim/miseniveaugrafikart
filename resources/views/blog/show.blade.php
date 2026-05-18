@extends('base')

@section('title', $post->title)

@section('content')

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="{{ route('blog.index') }}" class="hover:text-indigo-600 transition-colors">Accueil</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        @if ($post->category)
            <a href="{{ route('blog.index', ['category' => $post->category_id]) }}"
                class="hover:text-indigo-600 transition-colors">{{ $post->category->name }}</a>
            <i class="fa-solid fa-chevron-right text-xs"></i>
        @endif
        <span class="text-gray-600 truncate max-w-xs">{{ $post->title }}</span>
    </nav>

    <div class="lg:grid lg:grid-cols-[1fr_320px] lg:gap-10">

        {{-- Article principal --}}
        <article>
            {{-- Hero image --}}
            @if ($post->image)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-md">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                        class="w-full object-cover" style="max-height: 460px">
                </div>
            @else
                <div class="rounded-2xl bg-linear-to-br from-indigo-50 to-violet-100 h-64 flex items-center justify-center mb-8">
                    <i class="fa-solid fa-newspaper text-indigo-200 text-6xl"></i>
                </div>
            @endif

            {{-- Meta badges --}}
            <div class="flex flex-wrap items-center gap-2 mb-5">
                @if ($post->category)
                    <a href="{{ route('blog.index', ['category' => $post->category_id]) }}"
                        class="px-3 py-1 bg-amber-100 hover:bg-amber-200 text-amber-700 text-xs font-bold rounded-full uppercase tracking-wide transition-colors">
                        {{ $post->category->name }}
                    </a>
                @endif
                @foreach ($post->tags as $tag)
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs rounded-full">
                        #{{ $tag->name }}
                    </span>
                @endforeach
                <span class="ml-auto text-xs text-gray-400">
                    <i class="fa-regular fa-calendar mr-1"></i>
                    {{ $post->created_at->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- Titre --}}
            <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-6">{{ $post->title }}</h1>

            {{-- Contenu --}}
            <div class="text-gray-700 text-base leading-8 whitespace-pre-line">
                {{ $post->content }}
            </div>

            {{-- Actions admin --}}
            @can('manage-posts')
                <div class="mt-10 pt-6 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-medium transition-colors">
                        <i class="fa-solid fa-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                        onsubmit="return confirm('Supprimer cet article ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-medium transition-colors cursor-pointer">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            @endcan
        </article>

        {{-- Sidebar --}}
        <aside class="mt-10 lg:mt-0 flex flex-col gap-6">

            {{-- À propos du blog --}}
            <div class="bg-linear-to-br from-indigo-600 to-violet-700 text-white rounded-2xl p-6">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Mon Blog</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    Retrouvez ici tous nos articles, actus et réflexions.
                </p>
            </div>

            {{-- Autres articles --}}
            @if ($remainingpost->isNotEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4">
                        Autres articles
                    </h3>
                    <div class="flex flex-col gap-4">
                        @foreach ($remainingpost as $other)
                            <a href="{{ route('blog.show', $other->slug) }}"
                                class="group flex items-start gap-3 hover:text-indigo-600 transition-colors">
                                <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-linear-to-br from-indigo-50 to-violet-100">
                                    @if ($other->image)
                                        <img src="{{ $other->imageUrl() }}" alt="{{ $other->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-200">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fa-solid fa-image text-indigo-200 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-sm text-gray-900 group-hover:text-indigo-600 leading-snug line-clamp-2 transition-colors">
                                        {{ $other->title }}
                                    </p>
                                    @if ($other->category)
                                        <p class="text-xs text-amber-600 mt-1">{{ $other->category->name }}</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Retour --}}
            <a href="{{ route('blog.index') }}"
                class="flex items-center justify-center gap-2 py-3 bg-white hover:bg-indigo-50 border border-gray-200 hover:border-indigo-300 text-gray-600 hover:text-indigo-600 rounded-2xl text-sm font-medium transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Retour au blog
            </a>
        </aside>
    </div>

@endsection
