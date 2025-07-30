<x-admin-layout>
    <x-slot name="header">
        Edit Data Gaji
    </x-slot>

    <div class="p-6">
        <div class="mx-auto space-y-6 max-w-4xl">
            <!-- Header Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Data Gaji</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Ubah struktur gaji untuk posisi {{ ucfirst($gaji->posisi) }}</p>
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

            <!-- Current vs New Values -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Values -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Nilai Saat Ini</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Posisi:</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($gaji->posisi) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Gaji Pokok:</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $gaji->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
                                {{ $gaji->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total Gaji:</span>
                                <span class="text-blue-600 dark:text-blue-400">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Nilai Baru</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('gaji.update', $gaji) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Posisi -->
                            <div>
                                <label for="posisi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Posisi <span class="text-red-500">*</span>
                                </label>
                                <select id="posisi" name="posisi" required
                                    class="w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('posisi') border-red-500 @enderror">
                                    <option value="">Pilih Posisi</option>
                                    <option value="admin" {{ old('posisi', $gaji->posisi) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="kasir" {{ old('posisi', $gaji->posisi) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    <option value="barista" {{ old('posisi', $gaji->posisi) == 'barista' ? 'selected' : '' }}>Barista</option>
                                    <option value="karyawan" {{ old('posisi', $gaji->posisi) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
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
                                        value="{{ old('gaji_pokok', $gaji->gaji_pokok) }}"
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
                                    {{ old('is_active', $gaji->is_active) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Status Aktif
                                </label>
                            </div>

                            <!-- Preview Section -->
                            <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <h4 class="mb-3 text-sm font-medium text-gray-800 dark:text-gray-100">Preview Perubahan</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>Gaji Pokok:</span>
                                        <span id="preview-gaji-pokok" class="font-medium">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="pt-2 border-t border-gray-300 dark:border-gray-600">
                                        <div class="flex justify-between text-sm font-semibold">
                                            <span>Total Gaji:</span>
                                            <span id="preview-total" class="text-blue-600 dark:text-blue-400">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="flex items-center justify-end space-x-4 pt-4">
                                <a href="{{ route('gaji.index') }}"
                                   class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700">
                                    Perbarui Data Gaji
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if($gaji->karyawans->count() > 0)
                <!-- Affected Employees Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 dark:bg-yellow-900/20 dark:border-yellow-800">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Perhatian!</h3>
                            <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-300">
                                Perubahan ini akan mempengaruhi {{ $gaji->karyawans->count() }} karyawan dengan posisi {{ ucfirst($gaji->posisi) }}.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
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
