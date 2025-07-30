<x-admin-layout>
    <x-slot name="header">
        Tambah Data Gaji
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Tambah Data Gaji</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Buat struktur gaji baru untuk posisi karyawan</p>
                        </div>
                        <a href="{{ route('gaji.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6">
                    <form action="{{ route('gaji.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Posisi -->
                        <div>
                            <label for="posisi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Posisi <span class="text-red-500">*</span>
                            </label>
                            <select id="posisi" name="posisi" required
                                class="w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('posisi') border-red-500 @enderror">
                                <option value="">Pilih Posisi</option>
                                <option value="admin" {{ old('posisi') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="kasir" {{ old('posisi') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="barista" {{ old('posisi') == 'barista' ? 'selected' : '' }}>Barista</option>
                                <option value="staff" {{ old('posisi') == 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                            @error('posisi')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gaji Pokok -->
                        <div>
                            <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Gaji Pokok <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400">Rp</span>
                                </div>
                                <input type="number" id="gaji_pokok" name="gaji_pokok"
                                    value="{{ old('gaji_pokok') }}"
                                    step="1000"
                                    min="0"
                                    placeholder="0"
                                    required
                                    class="w-full pl-8 pr-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('gaji_pokok') border-red-500 @enderror">
                            </div>
                            @error('gaji_pokok')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status Aktif
                            </label>
                        </div>

                        <!-- Preview Section -->
                        <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <h3 class="mb-3 text-lg font-medium text-gray-800 dark:text-gray-100">Preview Gaji</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Gaji Pokok:</span>
                                    <span id="preview-gaji-pokok" class="font-medium">Rp 0</span>
                                </div>
                                <div class="pt-2 border-t border-gray-300 dark:border-gray-600">
                                    <div class="flex justify-between text-base font-semibold">
                                        <span>Total Gaji:</span>
                                        <span id="preview-total" class="text-blue-600 dark:text-blue-400">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end pt-6 space-x-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('gaji.index') }}"
                               class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Simpan Data Gaji
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gajiPokokInput = document.getElementById('gaji_pokok');
            const previewGajiPokok = document.getElementById('preview-gaji-pokok');
            const previewTotal = document.getElementById('preview-total');

            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updatePreview() {
                const gajiPokok = parseInt(gajiPokokInput.value) || 0;

                previewGajiPokok.textContent = formatRupiah(gajiPokok);
                previewTotal.textContent = formatRupiah(gajiPokok);
            }

            // Event listeners
            gajiPokokInput.addEventListener('input', updatePreview);

            // Initial update
            updatePreview();
        });
    </script>
</x-admin-layout>
