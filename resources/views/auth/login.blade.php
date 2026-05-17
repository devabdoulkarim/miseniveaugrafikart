@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')

    <div class="w-full max-w-xs flex flex-col items-center py-10">

        {{-- Logo --}}
        <a href="{{ route('blog.index') }}" class="mb-5">
            <span class="flex items-center justify-center bg-white rounded-2xl p-1.5 shadow-md ring-1 ring-gray-200">
                <img src="{{ asset('images/logo.avif') }}" alt="MonBlog" class="h-12 w-12 object-cover rounded-xl">
            </span>
        </a>

        {{-- Titre --}}
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Se connecter</h1>

        {{-- Card --}}
        <div class="w-full max-w-sm bg-white border border-gray-300 rounded-xl p-5 shadow-sm">

            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-800 mb-1.5">
                        Adresse email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        autocomplete="email" required
                        class="w-full border rounded-lg px-3 py-2 text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition
                               {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Mot de passe --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="text-sm font-semibold text-gray-800">Mot de passe</label>
                        <a href="#" class="text-xs text-indigo-600 hover:underline">Mot de passe oublié ?</a>
                    </div>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                            autocomplete="current-password" required
                            class="w-full border rounded-lg px-3 py-2 pr-10 text-sm text-gray-900 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition
                                   {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 transition-colors cursor-pointer"
                            tabindex="-1">
                            <i id="eyeIcon" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bouton connexion --}}
                <button type="submit"
                    class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-colors cursor-pointer mt-1">
                    Se connecter
                </button>
            </form>

            {{-- Séparateur --}}
            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-gray-200"></div>
                <span class="text-xs text-gray-400 font-medium">ou</span>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            {{-- Boutons sociaux --}}
            <div class="flex flex-col gap-2">
                <a href="{{ route('auth.google') }}"
                    class="w-full flex items-center justify-center gap-2.5 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continuer avec Google
                </a>

                <button type="button" disabled
                    class="w-full flex items-center justify-center gap-2.5 py-2 border border-gray-200 rounded-lg text-sm text-gray-400 cursor-not-allowed bg-gray-50">
                    <i class="fa-brands fa-apple text-base shrink-0"></i>
                    Continuer avec Apple
                </button>
            </div>
        </div>

        {{-- Retour au blog --}}
        <p class="mt-5 text-sm text-gray-500">
            <a href="{{ route('blog.index') }}" class="text-indigo-600 hover:underline font-medium">
                ← Retour au blog
            </a>
        </p>

    </div>

@endsection

@push('scripts')
<script>
    const toggle = document.getElementById('togglePassword');
    const input  = document.getElementById('password');
    const icon   = document.getElementById('eyeIcon');

    toggle.addEventListener('click', () => {
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.classList.toggle('fa-eye', !isHidden);
        icon.classList.toggle('fa-eye-slash', isHidden);
    });
</script>
@endpush
