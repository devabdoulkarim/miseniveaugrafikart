<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <title>@yield('title', 'Mon Blog')</title>
</head>

<body class="bg-slate-50 min-h-screen text-gray-900 antialiased">

    <header class="bg-slate-900 sticky top-0 z-50 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <a href="{{ route('blog.index') }}"
                    class="flex items-center gap-3 group">
                    <span class="flex items-center justify-center bg-white rounded-xl p-1 shadow-lg ring-1 ring-white/20 group-hover:ring-indigo-400 transition-all duration-200">
                        <img src="{{ asset('images/logo.avif') }}" alt="Mon Blog"
                            class="h-9 w-9 object-cover rounded-lg">
                    </span>
                    <span class="text-white font-bold text-base tracking-tight hidden sm:block">
                        Mon<span class="text-indigo-400">Blog</span>
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('blog.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                               {{ request()->routeIs('blog.index') ? 'bg-slate-700 text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        Accueil
                    </a>
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    @can('admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-1.5 text-sm px-4 py-1.5 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium transition-colors">
                            <i class="fa-solid fa-gauge text-xs"></i> Backoffice
                        </a>
                    @endcan
                    @guest
                        <a href="{{ route('login') }}"
                            class="text-sm px-5 py-2 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium transition-colors">
                            Se connecter
                        </a>
                    @endguest
                </div>

                <button class="md:hidden text-slate-400 hover:text-white p-2 rounded-lg transition-colors"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-700/50">
            <div class="max-w-7xl mx-auto px-4 py-3 flex flex-col gap-1">
                <a href="{{ route('blog.index') }}" class="px-3 py-2 text-slate-300 hover:text-white hover:bg-slate-800 rounded-lg text-sm transition-colors">Accueil</a>
                @can('admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-indigo-400 hover:text-indigo-300 rounded-lg text-sm transition-colors">
                        <i class="fa-solid fa-gauge mr-1"></i> Backoffice
                    </a>
                @endcan
                @guest
                    <a href="{{ route('login') }}" class="px-3 py-2 text-indigo-400 hover:text-indigo-300 text-sm">Se connecter</a>
                @endguest
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        @if (session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg px-4 py-3 mb-4">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg shrink-0"></i>
                <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-center gap-3 bg-red-50 border-l-4 border-red-500 rounded-lg px-4 py-3 mb-4">
                <i class="fa-solid fa-circle-xmark text-red-500 text-lg shrink-0"></i>
                <span class="text-sm font-medium text-red-800">{{ session('error') }}</span>
            </div>
        @endif
        @if (session('warning'))
            <div class="flex items-center gap-3 bg-amber-50 border-l-4 border-amber-500 rounded-lg px-4 py-3 mb-4">
                <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg shrink-0"></i>
                <span class="text-sm font-medium text-amber-800">{{ session('warning') }}</span>
            </div>
        @endif
        @if (session('info'))
            <div class="flex items-center gap-3 bg-blue-50 border-l-4 border-blue-500 rounded-lg px-4 py-3 mb-4">
                <i class="fa-solid fa-circle-info text-blue-500 text-lg shrink-0"></i>
                <span class="text-sm font-medium text-blue-800">{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
