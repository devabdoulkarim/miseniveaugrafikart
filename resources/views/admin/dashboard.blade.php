@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <span>Backoffice</span>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Dashboard</span>
@endsection

@section('actions')
    <a href="{{ route('admin.posts.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
        <i class="fa-solid fa-plus text-xs"></i> Nouvel article
    </a>
@endsection

@section('content')

    {{-- Stats cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        @php
            $cards = [
                ['label' => 'Articles',     'value' => $stats['posts'],      'icon' => 'fa-newspaper',   'color' => 'indigo'],
                ['label' => 'Catégories',   'value' => $stats['categories'], 'icon' => 'fa-folder-open', 'color' => 'amber'],
                ['label' => 'Tags',         'value' => $stats['tags'],       'icon' => 'fa-tags',        'color' => 'violet'],
                ['label' => 'Utilisateurs', 'value' => $stats['users'],      'icon' => 'fa-users',       'color' => 'emerald'],
            ];
            $colors = [
                'indigo'  => ['bg' => 'bg-indigo-50',  'icon' => 'text-indigo-600'],
                'amber'   => ['bg' => 'bg-amber-50',   'icon' => 'text-amber-600'],
                'violet'  => ['bg' => 'bg-violet-50',  'icon' => 'text-violet-600'],
                'emerald' => ['bg' => 'bg-emerald-50', 'icon' => 'text-emerald-600'],
            ];
        @endphp

        @foreach ($cards as $card)
            @php $c = $colors[$card['color']]; @endphp
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 {{ $c['bg'] }} rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid {{ $card['icon'] }} {{ $c['icon'] }} text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $card['value'] }}</p>
                    <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Graphiques --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

        {{-- Publications par mois --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-semibold text-gray-900">Publications par mois</h2>
                    <p class="text-xs text-gray-400 mt-0.5">6 derniers mois</p>
                </div>
                <span class="p-2 bg-indigo-50 rounded-xl">
                    <i class="fa-solid fa-chart-column text-indigo-500"></i>
                </span>
            </div>
            <div class="h-56">
                <canvas id="chartPostsByMonth"
                    data-labels="{{ json_encode($chartPostsByMonth->pluck('month')) }}"
                    data-values="{{ json_encode($chartPostsByMonth->pluck('total')) }}">
                </canvas>
            </div>
        </div>

        {{-- Articles par catégorie --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-semibold text-gray-900">Par catégorie</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Répartition des articles</p>
                </div>
                <span class="p-2 bg-amber-50 rounded-xl">
                    <i class="fa-solid fa-chart-pie text-amber-500"></i>
                </span>
            </div>
            <div class="h-56">
                <canvas id="chartPostsByCategory"
                    data-labels="{{ json_encode($chartPostsByCategory->pluck('name')) }}"
                    data-values="{{ json_encode($chartPostsByCategory->pluck('posts_count')) }}">
                </canvas>
            </div>
        </div>
    </div>

    {{-- Tags + Articles récents --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Articles récents --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-900">Articles récents</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-xs text-indigo-600 hover:underline">Voir tous →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse ($recentPosts as $post)
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0 text-indigo-400 font-bold text-sm">
                            {{ $loop->iteration }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 text-sm truncate">{{ $post->title }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                @if ($post->category)
                                    <span class="text-xs text-amber-600">{{ $post->category->name }}</span>
                                    <span class="text-gray-300">·</span>
                                @endif
                                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 shrink-0">
                            <a href="{{ route('admin.posts.edit', $post) }}"
                                class="p-1.5 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                                <i class="fa-solid fa-pencil text-xs"></i>
                            </a>
                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                class="p-1.5 text-indigo-500 hover:bg-indigo-50 rounded-lg transition-colors" title="Voir">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-10 text-center text-gray-400 text-sm">Aucun article.</div>
                @endforelse
            </div>
        </div>

        {{-- Tags les plus utilisés --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-semibold text-gray-900">Tags populaires</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Utilisation par article</p>
                </div>
                <span class="p-2 bg-violet-50 rounded-xl">
                    <i class="fa-solid fa-tags text-violet-500"></i>
                </span>
            </div>
            <div class="h-56">
                <canvas id="chartTags"
                    data-labels="{{ json_encode($chartTags->pluck('name')) }}"
                    data-values="{{ json_encode($chartTags->pluck('posts_count')) }}">
                </canvas>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/dashboard.js')
@endpush
