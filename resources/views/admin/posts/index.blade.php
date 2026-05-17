@extends('layouts.admin')

@section('title', 'Articles')
@section('page-title', 'Gestion des articles')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Articles</span>
@endsection

@section('actions')
    <a href="{{ route('admin.posts.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
        <i class="fa-solid fa-plus text-xs"></i> Nouvel article
    </a>
@endsection

@section('content')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">#</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Article</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Catégorie</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Tags</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Date</th>
                    <th class="text-center px-6 py-3.5 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($posts as $post)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ $post->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($post->image)
                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                        class="w-10 h-10 rounded-xl object-cover shrink-0">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                                        <i class="fa-solid fa-image text-indigo-200 text-sm"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $post->title }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($post->content, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if ($post->category)
                                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full uppercase">
                                    {{ $post->category->name }}
                                </span>
                            @else
                                <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($post->tags as $tag)
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-xs rounded-full">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">
                            {{ $post->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                    class="p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition-colors" title="Voir">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                                    <i class="fa-solid fa-pencil text-xs"></i>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                    onsubmit="return confirm('Supprimer « {{ $post->title }} » ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Supprimer">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                            <i class="fa-solid fa-newspaper text-3xl mb-3 block text-gray-200"></i>
                            Aucun article pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection
