<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Informations --}}
    <div class="lg:col-span-2 flex flex-col gap-5">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-5">Informations</h2>

            <div class="flex flex-col gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom du rôle <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Ex : Rédacteur">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                        placeholder="Description optionnelle du rôle...">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Permissions --}}
    <div class="flex flex-col gap-5">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-5">Permissions</h2>

            <div class="flex flex-col gap-2">
                @foreach ($permissions as $permission)
                    <label class="flex items-start gap-3 p-3 rounded-xl hover:bg-slate-50 cursor-pointer transition-colors group">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                            class="mt-0.5 rounded text-indigo-600 border-gray-300 focus:ring-indigo-500 cursor-pointer">
                        <div>
                            <p class="text-sm font-medium text-gray-800 group-hover:text-indigo-700 transition-colors">{{ $permission->name }}</p>
                            @if ($permission->description)
                                <p class="text-xs text-gray-400 mt-0.5">{{ $permission->description }}</p>
                            @endif
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit"
            class="w-full flex items-center justify-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-colors shadow-sm cursor-pointer">
            <i class="fa-solid fa-floppy-disk"></i>
            Enregistrer
        </button>
    </div>
</div>
