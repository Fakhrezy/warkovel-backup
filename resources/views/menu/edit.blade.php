<x-admin-layout>
    <x-slot name="header">
        Edit Menu
    </x-slot>

    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Edit Menu</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Silakan edit data menu</p>
                </div>

                <form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Menu -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Menu</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $menu->nama) }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama menu">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                        <div class="relative">
                            <select id="kategori" name="kategori"
                                class="appearance-none w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror"
                                style="-webkit-appearance: none; -moz-appearance: none; appearance: none;">
                                <option value="">Pilih Kategori</option>
                                <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                            </select>

                        </div>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar Menu -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gambar Menu</label>

                        @if($menu->gambar)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        @endif

                        <!-- Preview area for new image -->
                        <div id="imagePreview" class="hidden mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview gambar baru:</p>
                            <img id="previewImg" src="#" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="gambar" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>{{ $menu->gambar ? 'Ganti gambar' : 'Upload gambar' }}</span>
                                        <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        function previewImage(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('previewImg').src = e.target.result;
                                    document.getElementById('imagePreview').classList.remove('hidden');
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Harga</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500 dark:text-gray-400">Rp</span>
                            <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga') border-red-500 @enderror"
                                placeholder="0" min="0" step="1000">
                        </div>
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resep -->
                    <div>
                        <label for="resep" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Resep</label>
                        <textarea id="resep" name="resep" rows="5"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('resep') border-red-500 @enderror"
                            placeholder="Tulis resep atau cara pembuatan menu...">{{ old('resep', $menu->resep) }}</textarea>
                        @error('resep')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('menu.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
