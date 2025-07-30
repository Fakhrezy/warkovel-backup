<x-admin-layout>
    <x-slot name="header">
        Kelola Karyawan
    </x-slot>

    <div class="p-6">
        <div class="mx-auto space-y-6 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Karyawan</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kelola data karyawan cafe</p>
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

            <!-- Statistics Cards -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="p-6 transition-shadow border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500 rounded-full bg-opacity-20 dark:bg-blue-500/30">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Staff</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $countByPosition['staff'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-500 rounded-full bg-opacity-20 dark:bg-yellow-500/30">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Barista</h3>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $countByPosition['barista'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-500 rounded-full bg-opacity-20 dark:bg-green-500/30">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Kasir</h3>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $countByPosition['kasir'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 transition-shadow border border-purple-200 rounded-lg bg-purple-50 dark:bg-purple-900/20 dark:border-purple-800 hover:shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-500 rounded-full bg-opacity-20 dark:bg-purple-500/30">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Admin</h3>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $countByPosition['admin'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <!-- Search and Filter Section -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <form method="GET" action="{{ route('karyawan.index') }}" class="flex flex-col items-end gap-4 lg:flex-row">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cari Karyawan</label>
                            <div class="relative">
                                <input type="text" id="search" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan nama, email, atau telepon..."
                                    class="w-full py-2 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-500 bg-white border border-gray-300 rounded-lg dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Position Filter -->
                        <div class="w-full sm:w-48">
                            <label for="filter_posisi" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Filter Posisi</label>
                            <div class="relative">
                                <select id="filter_posisi" name="filter_posisi"
                                    class="w-full py-2 pl-3 pr-8 text-sm text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;">
                                    <option value="all" {{ request('filter_posisi', 'all') == 'all' ? 'selected' : '' }}>Semua Posisi</option>
                                    <option value="staff" {{ request('filter_posisi') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="barista" {{ request('filter_posisi') == 'barista' ? 'selected' : '' }}>Barista</option>
                                    <option value="kasir" {{ request('filter_posisi') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    <option value="admin" {{ request('filter_posisi') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>

                            </div>
                        </div>

                        <!-- Per Page Selector -->
                        <div class="w-full sm:w-40">
                            <label for="per_page" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Per Halaman</label>
                            <div class="relative">
                                <select name="per_page" id="per_page"
                                    class="w-full py-2 pl-3 pr-8 text-sm text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                                    onchange="updatePerPage(this.value)">
                                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            @if(request('search') || request('filter_posisi', 'all') !== 'all')
                                <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-gray-500 border border-transparent rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                            <a href="{{ route('karyawan.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Karyawan
                            </a>
                        </div>

                        <!-- Hidden field to preserve per_page -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">ID</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Nama</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Umur</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Jenis Kelamin</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Posisi</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Gaji</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Status</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse($karyawan as $k)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $k->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $k->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $k->umur }} tahun</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $k->jenis_kelamin }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            @if($k->posisi == 'staff') bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400
                                            @elseif($k->posisi == 'barista') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400
                                            @elseif($k->posisi == 'kasir') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400
                                            @elseif($k->posisi == 'admin') bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400
                                            @else bg-gray-100 dark:bg-gray-900/30 text-gray-800 dark:text-gray-400
                                            @endif">
                                            {{ ucfirst($k->posisi) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $k->formatted_gaji }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($k->status == 'aktif')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">
                                            Aktif
                                        </span>
                                        @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-400">
                                            Tidak Aktif
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('karyawan.show', $k) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 text-blue-700 transition duration-150 ease-in-out bg-blue-100 border border-transparent rounded-md dark:text-blue-400 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat
                                            </a>
                                            <a href="{{ route('karyawan.edit', $k) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 text-yellow-700 transition duration-150 ease-in-out bg-yellow-100 border border-transparent rounded-md dark:text-yellow-400 dark:bg-yellow-900/30 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('karyawan.destroy', $k) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 text-red-700 transition duration-150 ease-in-out bg-red-100 border border-transparent rounded-md dark:text-red-400 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 mb-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <p class="text-lg font-medium text-gray-500 dark:text-gray-400">Tidak ada data karyawan</p>
                                            <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">Silakan tambah karyawan baru untuk memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($karyawan->hasPages())
                <div class="mt-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between px-6 py-4">
                        <!-- Mobile Pagination -->
                        <div class="flex items-center justify-between flex-1 sm:hidden">
                            <div class="text-sm text-gray-700">
                                <span class="font-medium">{{ $karyawan->currentPage() }}</span>
                                dari
                                <span class="font-medium">{{ $karyawan->lastPage() }}</span>
                                halaman
                            </div>
                            <div class="flex space-x-1">
                                @if ($karyawan->onFirstPage())
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&lt;</span>
                                @else
                                    <a href="{{ $karyawan->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&lt;</a>
                                @endif

                                @if ($karyawan->hasMorePages())
                                    <a href="{{ $karyawan->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&gt;</a>
                                @else
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&gt;</span>
                                @endif
                            </div>
                        </div>

                        <!-- Desktop Pagination -->
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $karyawan->firstItem() ?? 0 }}</span>
                                    sampai
                                    <span class="font-medium">{{ $karyawan->lastItem() ?? 0 }}</span>
                                    dari
                                    <span class="font-medium">{{ $karyawan->total() }}</span>
                                    hasil
                                </p>
                            </div>
                            <div>
                                <nav class="flex items-center space-x-1" aria-label="Pagination">
                                    {{-- First Page --}}
                                    @if ($karyawan->currentPage() > 1)
                                        <a href="{{ $karyawan->url(1) }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&lt;&lt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&lt;&lt;</span>
                                    @endif

                                    {{-- Previous Page --}}
                                    @if ($karyawan->onFirstPage())
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&lt;</span>
                                    @else
                                        <a href="{{ $karyawan->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&lt;</a>
                                    @endif

                                    {{-- Current Page Info --}}
                                    <span class="px-4 py-2 text-sm font-medium text-blue-600 border border-blue-300 rounded-md bg-blue-50">
                                        {{ $karyawan->currentPage() }} / {{ $karyawan->lastPage() }}
                                    </span>

                                    {{-- Next Page --}}
                                    @if ($karyawan->hasMorePages())
                                        <a href="{{ $karyawan->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&gt;</span>
                                    @endif

                                    {{-- Last Page --}}
                                    @if ($karyawan->currentPage() < $karyawan->lastPage())
                                        <a href="{{ $karyawan->url($karyawan->lastPage()) }}" class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-md hover:bg-gray-50">&gt;&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">&gt;&gt;</span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
function updatePerPage(perPage) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', perPage);
    window.location.href = url.toString();
}
</script>
