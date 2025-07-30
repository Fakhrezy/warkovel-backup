<x-admin-layout>
    <x-slot name="header">
        Detail Data Gaji - {{ ucfirst($gaji->posisi) }}
    </x-slot>

    <div class="p-6">
        <div class="mx-auto space-y-6 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Detail Data Gaji</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Informasi lengkap struktur gaji untuk posisi {{ ucfirst($gaji->posisi) }}</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('gaji.edit', $gaji) }}"
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-yellow-700 transition-colors duration-200 bg-yellow-100 border border-yellow-300 rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800 dark:hover:bg-yellow-900/40">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
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
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Salary Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Salary Breakdown -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Rincian Gaji</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Gaji Pokok Card -->
                                <div class="p-6 transition-shadow border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 hover:shadow-md">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-blue-500 rounded-full bg-opacity-20 dark:bg-blue-500/30">
                                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-800 dark:text-gray-100">Gaji Pokok</h4>
                                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                                Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Gaji Card -->
                                <div class="p-6 transition-shadow border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 hover:shadow-md">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-green-500 rounded-full bg-opacity-20 dark:bg-green-500/30">
                                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-800 dark:text-gray-100">Total Gaji</h4>
                                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                                Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employees List -->
                    @if($gaji->karyawans->count() > 0)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                    Karyawan dengan Posisi {{ ucfirst($gaji->posisi) }} ({{ $gaji->karyawans->count() }} orang)
                                </h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Nama</th>
                                            <th scope="col" class="px-6 py-3">Email</th>
                                            <th scope="col" class="px-6 py-3">No. Telepon</th>
                                            <th scope="col" class="px-6 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @foreach($gaji->karyawans as $karyawan)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                                    <div class="flex items-center">
                                                        <div class="flex items-center justify-center w-8 h-8 mr-3 text-xs font-bold text-white bg-blue-600 rounded-full">
                                                            {{ strtoupper(substr($karyawan->nama, 0, 1)) }}
                                                        </div>
                                                        {{ $karyawan->nama }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                    {{ $karyawan->email }}
                                                </td>
                                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                                    {{ $karyawan->telepon ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if($karyawan->status === 'aktif')
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300">
                                                            Aktif
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300">
                                                            Tidak Aktif
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Karyawan Terkait</h3>
                            </div>
                            <div class="p-6 text-center">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada karyawan</h3>
                                <p class="text-gray-600 dark:text-gray-400">Belum ada karyawan yang menggunakan posisi {{ ucfirst($gaji->posisi) }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <!-- Basic Info -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Informasi Umum</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Posisi</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($gaji->posisi) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                                <div class="mt-1">
                                    @if($gaji->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300">
                                            <svg class="w-2 h-2 mr-1 fill-current" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Dibuat</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $gaji->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Terakhir Diperbarui</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $gaji->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Statistik</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah Karyawan:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $gaji->karyawans->count() }} orang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Karyawan Aktif:</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $gaji->karyawans->where('status', 'aktif')->count() }} orang
                                </span>
                            </div>
                            @if($gaji->karyawans->count() > 0)
                                <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Pengeluaran Gaji:</span>
                                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                            Rp {{ number_format($gaji->total_gaji * $gaji->karyawans->where('status', 'aktif')->count(), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Aksi</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('gaji.edit', $gaji) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-yellow-700 transition-colors duration-200 bg-yellow-100 border border-yellow-300 rounded-lg hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800 dark:hover:bg-yellow-900/40">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Gaji
                            </a>
                            <form action="{{ route('gaji.destroy', $gaji) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-700 transition-colors duration-200 bg-red-100 border border-red-300 rounded-lg hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900/20 dark:text-red-400 dark:border-red-800 dark:hover:bg-red-900/40"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data gaji untuk posisi {{ $gaji->posisi }}? Data yang terhapus tidak dapat dikembalikan.')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Gaji
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
