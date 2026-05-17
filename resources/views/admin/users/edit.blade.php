@extends('layouts.admin')

@section('title', 'Rôles — ' . $user->name)
@section('page-title', 'Gérer les rôles')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <a href="{{ route('admin.users.index') }}" class="hover:text-indigo-600 transition-colors">Utilisateurs</a>
    <i class="fa-solid fa-chevron-right text-[10px]"></i>
    <span class="text-gray-600">{{ $user->name }}</span>
@endsection

@section('content')

    <div class="max-w-xl">
        {{-- User info card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-xl font-bold shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-900">{{ $user->name }}</p>
                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        {{-- Role assignment form --}}
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-5">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-5">Rôles assignés</h2>

                <div class="flex flex-col gap-2">
                    @foreach ($roles as $role)
                        <label class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 cursor-pointer transition-colors group">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                                class="mt-0.5 rounded text-indigo-600 border-gray-300 focus:ring-indigo-500 cursor-pointer">
                            <div>
                                <p class="text-sm font-semibold text-gray-800 group-hover:text-indigo-700 transition-colors">{{ $role->name }}</p>
                                @if ($role->description)
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $role->description }}</p>
                                @endif
                                <div class="flex flex-wrap gap-1 mt-1.5">
                                    @foreach ($role->permissions as $permission)
                                        <span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-600 text-[10px] rounded border border-emerald-100">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 flex items-center justify-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-3 bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium transition-colors">
                    Annuler
                </a>
            </div>
        </form>
    </div>

@endsection
