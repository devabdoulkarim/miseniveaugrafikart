@extends('base')

@section('title', 'Se connecter')

@section('content')

    <div class="min-h-[60vh] flex items-center justify-center">
        <div class="w-full max-w-md">

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-indigo-600 rounded-2xl mb-4 shadow-lg">
                    <i class="fa-solid fa-pen-nib text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Bon retour !</h1>
                <p class="text-gray-500 text-sm mt-1">Connectez-vous à votre compte</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form action="{{ route('login') }}" method="post" class="flex flex-col gap-5">
                    @csrf

                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-sm font-medium text-gray-700">Adresse email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            autocomplete="email" required placeholder="vous@exemple.com"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                                   placeholder-gray-400 {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        @error('email')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-sm font-medium text-gray-700">Mot de passe</label>
                        <input id="password" type="password" name="password"
                            autocomplete="current-password" required placeholder="••••••••"
                            class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                                   placeholder-gray-400 {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        @error('password')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm mt-1 cursor-pointer">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
