<x-admin-layout>
    <x-slot name="header">
        Edit Karyawan
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Data Karyawan</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Perbarui informasi karyawan: {{ $karyawan->nama }}</p>
                    </div>
                    <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <form action="{{ route('karyawan.update', $karyawan) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-medium">Terdapat kesalahan pada form:</h4>
                                    <ul class="mt-2 list-disc list-inside text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $karyawan->nama) }}" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Umur -->
                        <div>
                            <label for="umur" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Umur <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="umur" id="umur" value="{{ old('umur', $karyawan->umur) }}" min="17" max="65" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('umur')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Posisi -->
                        <div>
                            <label for="posisi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Posisi <span class="text-red-500">*</span>
                            </label>
                            <select name="posisi" id="posisi" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Posisi</option>
                                <option value="karyawan" {{ old('posisi', $karyawan->posisi) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                <option value="barista" {{ old('posisi', $karyawan->posisi) == 'barista' ? 'selected' : '' }}>Barista</option>
                                <option value="kasir" {{ old('posisi', $karyawan->posisi) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                            </select>
                            @error('posisi')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gaji -->
                        <div>
                            <label for="gaji" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Gaji <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="gaji" id="gaji" value="{{ old('gaji', $karyawan->gaji) }}" min="0" step="1000" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Contoh: 3000000">
                            @error('gaji')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="aktif" {{ old('status', $karyawan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak aktif" {{ old('status', $karyawan->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat" id="alamat" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Masukkan alamat lengkap">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('karyawan.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-md font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-yellow-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-wide hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Update Karyawan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
