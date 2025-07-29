<x-admin-layout>
    <x-slot name="header">
        Detail Kehadiran Karyawan
    </x-slot>

    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <!-- Header -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detail Kehadiran</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ $kehadiran->karyawan->nama }} - {{ $kehadiran->formatted_tanggal }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('kehadiran.edit', $kehadiran) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-yellow-600 border border-transparent rounded-lg dark:bg-yellow-700 hover:bg-yellow-700 dark:hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('kehadiran.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-gray-500 border border-transparent rounded-lg dark:bg-gray-600 hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Karyawan Information -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Informasi Karyawan</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ $kehadiran->karyawan->nama }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kehadiran->karyawan->email }}</p>
                                </div>
                            </div>

                            <div class="pt-4 space-y-3 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Posisi:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($kehadiran->karyawan->posisi == 'barista') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400
                                        @elseif($kehadiran->karyawan->posisi == 'kasir') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400
                                        @else bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400
                                        @endif">
                                        {{ ucfirst($kehadiran->karyawan->posisi) }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">No. Telepon:</span>
                                    <span class="text-sm text-gray-900 dark:text-gray-100">{{ $kehadiran->karyawan->no_telepon }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat:</span>
                                    <span class="text-sm text-right text-gray-900 dark:text-gray-100 max-w-32">{{ $kehadiran->karyawan->alamat }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Bergabung:</span>
                                    <span class="text-sm text-gray-900 dark:text-gray-100">{{ $kehadiran->karyawan->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Detail Kehadiran</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- Tanggal -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal</label>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $kehadiran->formatted_tanggal }}</span>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Status Kehadiran</label>
                                    <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                                        @if($kehadiran->status_kehadiran == 'hadir') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400
                                        @elseif($kehadiran->status_kehadiran == 'tidak_hadir') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400
                                        @elseif($kehadiran->status_kehadiran == 'izin') bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300
                                        @endif">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($kehadiran->status_kehadiran == 'hadir')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @elseif($kehadiran->status_kehadiran == 'tidak_hadir')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @endif
                                        </svg>
                                        {{ ucfirst(str_replace('_', ' ', $kehadiran->status_kehadiran)) }}
                                    </span>
                                </div>

                                @if($kehadiran->jam_masuk || $kehadiran->jam_keluar)
                                    <!-- Jam Masuk -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jam Masuk</label>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $kehadiran->jam_masuk ? $kehadiran->jam_masuk->format('H:i') : '-' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Jam Keluar -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jam Keluar</label>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $kehadiran->jam_keluar ? $kehadiran->jam_keluar->format('H:i') : 'Belum keluar' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if($kehadiran->jam_masuk && $kehadiran->jam_keluar)
                                <!-- Total Working Hours -->
                                <div class="p-4 mt-6 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-blue-700 dark:text-blue-400">Total Jam Kerja</p>
                                            <p class="text-xl font-bold text-blue-900 dark:text-blue-300">{{ $kehadiran->total_jam_kerja }} jam</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($kehadiran->keterangan)
                                <!-- Keterangan -->
                                <div class="mt-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Keterangan</label>
                                    <div class="p-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $kehadiran->keterangan }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Timestamps -->
                            <div class="pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-1 gap-4 text-sm text-gray-500 sm:grid-cols-2 dark:text-gray-400">
                                    <div>
                                        <span class="font-medium">Dibuat:</span>
                                        {{ $kehadiran->created_at->format('d M Y H:i') }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Diupdate:</span>
                                        {{ $kehadiran->updated_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Aksi</h3>
                    <form action="{{ route('kehadiran.destroy', $kehadiran) }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kehadiran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-lg dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Kehadiran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
