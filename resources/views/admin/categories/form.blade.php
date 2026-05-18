<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col gap-5">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">
            Nom de la catégorie <span class="text-red-500">*</span>
        </label>
        <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
            class="w-full px-4 py-2.5 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent
                   {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
            placeholder="Ex : Technologie" autofocus>
        @error('name')
            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit"
            class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm cursor-pointer">
            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
        <a href="{{ route('admin.categories.index') }}"
            class="px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-200 text-gray-600 rounded-xl text-sm font-medium transition-colors">
            Annuler
        </a>
    </div>
</div>
