<x-admin-layout>
    <x-slot name="header">
        Edit Kehadiran Karyawan
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Kehadiran</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                {{ $kehadiran->karyawan->nama }} - {{ $kehadiran->formatted_tanggal }}
                            </p>
                        </div>
                        <a href="{{ route('kehadiran.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium">Terdapat beberapa kesalahan:</h4>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <form action="{{ route('kehadiran.update', $kehadiran) }}" method="POST" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')

                    <!-- Karyawan Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Pilih Karyawan <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <select name="karyawan_id" id="karyawan_id" required
                                    class="appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg pl-3 pr-8 py-2 text-sm text-gray-700 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;">
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}" {{ old('karyawan_id', $kehadiran->karyawan_id) == $karyawan->id ? 'selected' : '' }}>
                                            {{ $karyawan->nama }} - {{ ucfirst($karyawan->posisi) }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            @error('karyawan_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tanggal <span class="text-red-500 dark:text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal" id="tanggal" required
                                value="{{ old('tanggal', $kehadiran->tanggal->format('Y-m-d')) }}"
                                class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Kehadiran -->
                    <div>
                        <label for="status_kehadiran" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Status Kehadiran <span class="text-red-500 dark:text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="status_kehadiran" id="status_kehadiran" required
                                class="appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg pl-3 pr-8 py-2 text-sm text-gray-700 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                                onchange="toggleTimeFields()">
                                <option value="">-- Pilih Status --</option>
                                <option value="hadir" {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="tidak_hadir" {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                <option value="izin" {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="sakit" {{ old('status_kehadiran', $kehadiran->status_kehadiran) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            </select>

                        </div>
                        @error('status_kehadiran')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jam Masuk & Keluar -->
                    <div id="time-fields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="jam_masuk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jam Masuk
                            </label>
                            <input type="time" name="jam_masuk" id="jam_masuk"
                                value="{{ old('jam_masuk', $kehadiran->jam_masuk ? $kehadiran->jam_masuk->format('H:i') : '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('jam_masuk')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jam_keluar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jam Keluar
                            </label>
                            <input type="time" name="jam_keluar" id="jam_keluar"
                                value="{{ old('jam_keluar', $kehadiran->jam_keluar ? $kehadiran->jam_keluar->format('H:i') : '') }}"
                                class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('jam_keluar')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Keterangan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                            placeholder="Tambahkan catatan atau keterangan jika diperlukan..."
                            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none">{{ old('keterangan', $kehadiran->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Working Hours (if applicable) -->
                    @if($kehadiran->jam_masuk && $kehadiran->jam_keluar)
                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-blue-700 dark:text-blue-400">
                                    <span class="font-medium">Total Jam Kerja:</span>
                                    {{ $kehadiran->total_jam_kerja }} jam
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('kehadiran.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Kehadiran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Helper Information -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-blue-700 dark:text-blue-400">
                        <h4 class="font-medium">Informasi Edit:</h4>
                        <ul class="mt-2 list-disc list-inside space-y-1">
                            <li>Ubah status kehadiran sesuai dengan kondisi aktual karyawan</li>
                            <li>Jam masuk dan keluar akan muncul jika status "Hadir"</li>
                            <li>Untuk status "Tidak Hadir", "Izin", atau "Sakit", jam akan dikosongkan</li>
                            <li>Perubahan data akan langsung mempengaruhi perhitungan total jam kerja</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
function toggleTimeFields() {
    const status = document.getElementById('status_kehadiran').value;
    const timeFields = document.getElementById('time-fields');
    const jamMasuk = document.getElementById('jam_masuk');
    const jamKeluar = document.getElementById('jam_keluar');

    if (status === 'hadir') {
        timeFields.style.display = 'grid';
        jamMasuk.required = true;
        jamKeluar.required = false; // Jam keluar tidak wajib, bisa diisi nanti
    } else {
        timeFields.style.display = 'none';
        jamMasuk.required = false;
        jamKeluar.required = false;
        // Clear values when hidden
        jamMasuk.value = '';
        jamKeluar.value = '';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleTimeFields();
});
</script>
