@extends('layouts.admin')

@section('title', 'Tags')
@section('page-title', 'Gestion des tags')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Tags</span>
@endsection

@section('actions')
    <a href="{{ route('admin.tags.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
        <i class="fa-solid fa-plus text-xs"></i> Nouveau tag
    </a>
@endsection

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($tags as $tag)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-hashtag text-violet-500 text-xs"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="font-semibold text-gray-900 truncate">{{ $tag->name }}</p>
                        <p class="text-xs text-gray-400">{{ $tag->posts_count }} article{{ $tag->posts_count !== 1 ? 's' : '' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-1 shrink-0">
                    <a href="{{ route('admin.tags.edit', $tag) }}"
                        class="p-1.5 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                        <i class="fa-solid fa-pencil text-xs"></i>
                    </a>
                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST"
                        onsubmit="return confirm('Supprimer ce tag ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="p-1.5 text-red-400 hover:bg-red-50 rounded-lg transition-colors cursor-pointer" title="Supprimer">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center text-gray-400">
                <i class="fa-solid fa-tags text-3xl mb-3 block text-gray-200"></i>
                Aucun tag.
            </div>
        @endforelse
    </div>

@endsection
