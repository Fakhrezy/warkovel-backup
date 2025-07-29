<x-admin-layout>
    <x-slot name="header">
        Tambah Menu Baru
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Tambah Menu Baru</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Silakan isi form untuk menambah menu baru</p>
                </div>

                <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <!-- Nama Menu -->
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Menu</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan nama menu" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori</option>
                            <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar Menu -->
                    <div>
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Menu</label>

                        <!-- Preview area -->
                        <div id="imagePreview" class="hidden mb-4">
                            <p class="mb-2 text-sm text-gray-600 dark:text-gray-400">Preview:</p>
                            <img id="previewImg" src="#" alt="Preview" class="object-cover w-32 h-32 border border-gray-300 rounded-lg dark:border-gray-600">
                        </div>

                        <div class="flex justify-center px-6 pt-5 pb-6 mt-1 transition-colors border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500">
                            <div class="space-y-1 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="gambar" class="relative font-medium text-blue-600 bg-white rounded-md cursor-pointer dark:bg-gray-700 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload gambar</span>
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

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
                        <div class="relative">
                            <span class="absolute text-gray-500 left-3 top-2 dark:text-gray-400">Rp</span>
                            <input type="number" id="harga" name="harga" value="{{ old('harga') }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('harga') border-red-500 @enderror"
                                placeholder="0" min="0" step="1000" required>
                        </div>
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Resep -->
                    <div>
                        <label for="resep" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Resep</label>
                        <textarea id="resep" name="resep" rows="5"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('resep') border-red-500 @enderror"
                            placeholder="Tulis resep atau cara pembuatan menu...">{{ old('resep') }}</textarea>
                        @error('resep')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('menu.index') }}"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Simpan Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
</x-admin-layout>
