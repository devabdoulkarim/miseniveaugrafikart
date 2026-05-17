@php
    $tagsIds = $post->exists ? $post->tags()->pluck('id') : collect();
    $action  = $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store');
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
    @csrf
    @if ($post->exists)
        @method('PATCH')
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Colonne principale --}}
        <div class="lg:col-span-2 flex flex-col gap-5">

            {{-- Titre --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-1.5">
                <label for="title" class="text-sm font-semibold text-gray-700">
                    Titre <span class="text-red-400">*</span>
                </label>
                <input id="title" type="text" name="title"
                    value="{{ old('title', $post->title ?? '') }}" required
                    placeholder="Titre de l'article..."
                    class="w-full rounded-xl border px-4 py-2.5 text-sm text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                           {{ $errors->has('title') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                @error('title')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contenu --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-1.5">
                <label for="content" class="text-sm font-semibold text-gray-700">
                    Contenu <span class="text-red-400">*</span>
                </label>
                <textarea id="content" name="content" rows="12" required
                    placeholder="Rédigez votre article ici..."
                    class="w-full rounded-xl border px-4 py-3 text-sm text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none
                           {{ $errors->has('content') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">{{ old('content', $post->content ?? '') }}</textarea>
                @error('content')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Colonne latérale --}}
        <div class="flex flex-col gap-5">

            {{-- Publication --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Publication</h3>
                <div class="flex flex-col gap-3">
                    <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm cursor-pointer">
                        <i class="fa-solid fa-{{ $post->exists ? 'floppy-disk' : 'paper-plane' }} mr-1.5"></i>
                        {{ $post->exists ? 'Enregistrer' : 'Publier' }}
                    </button>
                    <a href="{{ route('admin.posts.index') }}"
                        class="w-full py-2.5 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition-colors">
                        Annuler
                    </a>
                </div>
            </div>

            {{-- Image --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Image de couverture</h3>
                @if ($post->image)
                    <img src="{{ $post->imageUrl() }}" class="w-full h-32 object-cover rounded-xl mb-3" alt="Image actuelle">
                @endif
                <input id="image" type="file" name="image" accept="image/*"
                    class="block w-full text-xs text-gray-600
                           file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0
                           file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-700
                           hover:file:bg-indigo-100 cursor-pointer
                           {{ $errors->has('image') ? 'ring-2 ring-red-400 rounded-lg' : '' }}">
                @error('image')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Catégorie --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Catégorie <span class="text-red-400">*</span></h3>
                <select name="category_id"
                    class="w-full rounded-xl border px-3 py-2 text-sm text-gray-900
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                           {{ $errors->has('category_id') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                    <option value="">— Aucune —</option>
                    @foreach ($categories as $category)
                        <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Tags <span class="text-red-400">*</span></h3>
                <select name="tags[]" multiple
                    class="w-full rounded-xl border px-3 py-2 text-sm text-gray-900 h-32
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                           {{ $errors->has('tags') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                    @foreach ($tags as $tag)
                        <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-400 mt-1.5">Ctrl+clic pour sélection multiple</p>
                @error('tags')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</form>
