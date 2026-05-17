@extends('layouts.admin')

@section('title', 'Rôles & Permissions')
@section('page-title', 'Rôles & Permissions')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Rôles</span>
@endsection

@section('actions')
    <a href="{{ route('admin.roles.create') }}"
        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition-colors shadow-sm">
        <i class="fa-solid fa-plus text-xs"></i> Nouveau rôle
    </a>
@endsection

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach ($roles as $role)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex items-start justify-between gap-3 mb-4">
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $role->name }}</h3>
                            <span class="text-xs text-slate-400 font-mono">{{ $role->slug }}</span>
                        </div>
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-semibold rounded-full shrink-0">
                            {{ $role->users_count }} utilisateur{{ $role->users_count !== 1 ? 's' : '' }}
                        </span>
                    </div>

                    @if ($role->description)
                        <p class="text-sm text-gray-500 mb-4">{{ $role->description }}</p>
                    @endif

                    <div class="flex flex-wrap gap-1.5">
                        @forelse ($role->permissions as $permission)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-50 text-emerald-700 text-xs rounded-full border border-emerald-200">
                                <i class="fa-solid fa-check text-[9px]"></i>
                                {{ $permission->name }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400 italic">Aucune permission</span>
                        @endforelse
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <a href="{{ route('admin.roles.edit', $role) }}"
                        class="flex items-center gap-1.5 px-3 py-1.5 text-amber-600 hover:bg-amber-50 border border-amber-200 hover:border-amber-300 rounded-lg text-xs font-medium transition-colors">
                        <i class="fa-solid fa-pencil text-[10px]"></i> Modifier
                    </a>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST"
                        onsubmit="return confirm('Supprimer ce rôle ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center gap-1.5 px-3 py-1.5 text-red-500 hover:bg-red-50 border border-red-200 hover:border-red-300 rounded-lg text-xs font-medium transition-colors cursor-pointer">
                            <i class="fa-solid fa-trash text-[10px]"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection
