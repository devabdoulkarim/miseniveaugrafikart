@extends('layouts.admin')

@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des utilisateurs')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">Utilisateurs</span>
@endsection

@section('content')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Utilisateur</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Rôles</th>
                    <th class="text-left px-6 py-3.5 font-semibold text-gray-600">Inscription</th>
                    <th class="text-center px-6 py-3.5 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @forelse ($user->roles as $role)
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        {{ $role->slug === 'admin' ? 'bg-indigo-100 text-indigo-700' : ($role->slug === 'editor' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-gray-400 italic">Aucun rôle</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->created_at->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-amber-600 hover:bg-amber-50 border border-amber-200 hover:border-amber-300 rounded-lg text-xs font-medium transition-colors">
                                <i class="fa-solid fa-user-shield text-[10px]"></i> Rôles
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">Aucun utilisateur.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>

@endsection
