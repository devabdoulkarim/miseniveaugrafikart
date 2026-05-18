@extends('layouts.admin')

@section('title', 'Catégories')
@section('page-title', 'Gestion des catégories')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Catégories</span>
@endsection

@section('actions')
    <a href="{{ route('admin.categories.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
        <i class="fa-solid fa-plus text-xs"></i> Nouvelle catégorie
    </a>
@endsection

@section('content')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Nom</th>
                    <th class="text-center px-6 py-3.5 font-semibold text-gray-600">Articles</th>
                    <th class="text-center px-6 py-3.5 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-folder-open text-amber-500 text-xs"></i>
                                </div>
                                <span class="font-medium text-gray-900">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-semibold rounded-full">
                                {{ $category->posts_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="flex items-center gap-1.5 px-3 py-1.5 text-amber-600 hover:bg-amber-50 border border-amber-200 hover:border-amber-300 rounded-lg text-xs font-medium transition-colors">
                                    <i class="fa-solid fa-pencil text-[10px]"></i> Modifier
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-1.5 px-3 py-1.5 text-red-500 hover:bg-red-50 border border-red-200 hover:border-red-300 rounded-lg text-xs font-medium transition-colors cursor-pointer">
                                        <i class="fa-solid fa-trash text-[10px]"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center text-gray-400">
                            <i class="fa-solid fa-folder-open text-3xl mb-3 block text-gray-200"></i>
                            Aucune catégorie.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
