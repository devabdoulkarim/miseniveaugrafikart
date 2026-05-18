<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Admin') — Backoffice</title>
</head>

<body class="bg-slate-100 min-h-screen antialiased">

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 w-64 bg-slate-900 flex flex-col z-40 shadow-xl">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-slate-700/60">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <span class="flex items-center justify-center bg-white rounded-xl p-1 shadow ring-1 ring-white/10 group-hover:ring-indigo-400 transition-all">
                    <img src="{{ asset('images/logo.avif') }}" alt="Logo" class="h-8 w-8 object-cover rounded-lg">
                </span>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">MonBlog</p>
                    <p class="text-indigo-400 text-xs">Backoffice</p>
                </div>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 flex flex-col gap-1 overflow-y-auto">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Menu</p>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                       {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-chart-pie w-4 text-center"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.posts.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                       {{ request()->routeIs('admin.posts.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-newspaper w-4 text-center"></i>
                Articles
            </a>

            @can('manage-categories')
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                           {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-folder-open w-4 text-center"></i>
                    Catégories
                </a>
            @endcan

            @can('manage-tags')
                <a href="{{ route('admin.tags.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                           {{ request()->routeIs('admin.tags.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-tags w-4 text-center"></i>
                    Tags
                </a>
            @endcan

            @can('manage-users')
                <div class="my-3 border-t border-slate-700/50"></div>
                <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Administration</p>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                           {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-users w-4 text-center"></i>
                    Utilisateurs
                </a>
            @endcan

            @can('manage-roles')
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                           {{ request()->routeIs('admin.roles.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-shield-halved w-4 text-center"></i>
                    Rôles & Permissions
                </a>
            @endcan

            <div class="my-3 border-t border-slate-700/50"></div>
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-3 mb-2">Site</p>

            <a href="{{ route('blog.index') }}" target="_blank"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition-colors">
                <i class="fa-solid fa-globe w-4 text-center"></i>
                Voir le site
                <i class="fa-solid fa-arrow-up-right-from-square text-xs ml-auto opacity-50"></i>
            </a>
        </nav>

        {{-- User --}}
        <div class="px-4 py-4 border-t border-slate-700/60">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 text-xs truncate">{{ Auth::user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" title="Déconnexion"
                        class="text-slate-400 hover:text-red-400 transition-colors p-1 cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Contenu principal --}}
    <div class="ml-64 min-h-screen flex flex-col">

        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div>
                <h1 class="text-lg font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                @hasSection('breadcrumb')
                    <div class="flex items-center gap-1.5 text-xs text-gray-400 mt-0.5">
                        @yield('breadcrumb')
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-3">
                @yield('actions')
            </div>
        </header>

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="mx-8 mt-5 flex items-center gap-3 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl px-4 py-3">
                <i class="fa-solid fa-circle-check text-emerald-500 shrink-0"></i>
                <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mx-8 mt-5 flex items-center gap-3 bg-red-50 border-l-4 border-red-500 rounded-xl px-4 py-3">
                <i class="fa-solid fa-circle-xmark text-red-500 shrink-0"></i>
                <span class="text-sm font-medium text-red-800">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
