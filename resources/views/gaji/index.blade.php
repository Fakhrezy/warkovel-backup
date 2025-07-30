<x-admin-layout>
    <x-slot name="header">
        Kelola Gaji
    </x-slot>

    <div class="p-6">
        <div class="mx-auto space-y-6 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Gaji</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kelola struktur gaji berdasarkan posisi karyawan</p>
                        </div>
                        <a href="{{ route('gaji.create') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Gaji
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="px-4 py-3 text-green-700 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 py-3 text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800 dark:text-red-300">
                    <div class="flex">
                        <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                <div class="p-6 transition-shadow border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full bg-opacity-20 dark:bg-blue-500/30">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Posisi</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $gajis->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full bg-opacity-20 dark:bg-green-500/30">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Rata-rata Gaji</h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                {{ $gajis->count() > 0 ? 'Rp ' . number_format($gajis->avg('gaji_pokok'), 0, ',', '.') : 'Rp 0' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-500 rounded-full bg-opacity-20 dark:bg-yellow-500/30">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Gaji Tertinggi</h3>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                {{ $gajis->count() > 0 ? 'Rp ' . number_format($gajis->max('gaji_pokok'), 0, ',', '.') : 'Rp 0' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-purple-200 rounded-lg bg-purple-50 dark:bg-purple-900/20 dark:border-purple-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-500 rounded-full bg-opacity-20 dark:bg-purple-500/30">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Posisi Aktif</h3>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $gajis->where('is_active', true)->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <!-- Search and Filter Section -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <form method="GET" action="{{ route('gaji.index') }}" class="flex flex-col items-end gap-4 lg:flex-row">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cari Data Gaji</label>
                            <div class="relative">
                                <input type="text" id="search" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan posisi atau deskripsi..."
                                    class="w-full py-2 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="w-full sm:w-48">
                            <label for="filter_status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Filter Status</label>
                            <div class="relative">
                                <select id="filter_status" name="filter_status"
                                    class="w-full py-2 pl-3 pr-8 text-sm text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('filter_status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('filter_status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Filter
                            </button>
                            @if(request()->hasAny(['search', 'filter_status']))
                                <a href="{{ route('gaji.index') }}"
                                   class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Posisi</th>
                                <th scope="col" class="px-6 py-3">Gaji Pokok</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Jumlah Karyawan</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($gajis as $gaji)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        <div class="flex items-center">
                                            <div class="flex items-center justify-center w-8 h-8 mr-3 text-xs font-bold text-white bg-blue-600 rounded-full">
                                                {{ strtoupper(substr($gaji->posisi, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-semibold">{{ ucfirst($gaji->posisi) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
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
                                    </td>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300">
                                            {{ $gaji->karyawans->count() }} orang
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('gaji.show', $gaji) }}"
                                               class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-600 transition-colors duration-200 bg-blue-100 rounded hover:bg-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40"
                                               title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('gaji.edit', $gaji) }}"
                                               class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 transition-colors duration-200 bg-yellow-100 rounded hover:bg-yellow-200 dark:bg-yellow-900/20 dark:text-yellow-400 dark:hover:bg-yellow-900/40"
                                               title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('gaji.destroy', $gaji) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-600 transition-colors duration-200 bg-red-100 rounded hover:bg-red-200 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40"
                                                        title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data gaji untuk posisi {{ $gaji->posisi }}?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                            <h3 class="mb-2 text-lg font-medium">Belum ada data gaji</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Mulai dengan menambahkan struktur gaji untuk posisi karyawan</p>
                                            <a href="{{ route('gaji.create') }}"
                                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Tambah Data Gaji
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (if using paginate) -->
                @if(method_exists($gajis, 'hasPages') && $gajis->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $gajis->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom SweetAlert2 Styles for Dark Mode -->
    <style>
        .dark-popup {
            border: 1px solid #4b5563 !important;
        }

        .dark-popup .swal2-title {
            color: #f9fafb !important;
        }

        .dark-popup .swal2-content {
            color: #d1d5db !important;
        }
    </style>

    <!-- SweetAlert2 Auto-show -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Theme detection
            const isDarkMode = document.documentElement.classList.contains('dark') ||
                              localStorage.getItem('darkMode') === 'true' ||
                              (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);

            // Success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    background: isDarkMode ? '#1f2937' : '#ffffff',
                    color: isDarkMode ? '#f9fafb' : '#1f2937',
                    customClass: isDarkMode ? 'dark-popup' : '',
                    confirmButtonColor: '#10b981',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // Error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: @json(session('error')),
                    background: isDarkMode ? '#1f2937' : '#ffffff',
                    color: isDarkMode ? '#f9fafb' : '#1f2937',
                    customClass: isDarkMode ? 'dark-popup' : '',
                    confirmButtonColor: '#ef4444'
                });
            @endif
        });
    </script>
</x-admin-layout>
