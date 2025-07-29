<x-admin-layout>
    <x-slot name="header">
        Kelola Menu Cafe
    </x-slot>

    <div class="p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Menu</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola menu makanan dan minuman cafe</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg border border-blue-200 dark:border-blue-800 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-20 dark:bg-blue-500/30">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Total Menu</h3>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalMenus }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-orange-50 dark:bg-orange-900/20 p-6 rounded-lg border border-orange-200 dark:border-orange-800 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-orange-500 bg-opacity-20 dark:bg-orange-500/30">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Makanan</h3>
                            <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $countByKategori['makanan'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-cyan-50 dark:bg-cyan-900/20 p-6 rounded-lg border border-cyan-200 dark:border-cyan-800 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-cyan-500 bg-opacity-20 dark:bg-cyan-500/30">
                            <svg class="w-6 h-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Minuman</h3>
                            <p class="text-2xl font-bold text-cyan-600 dark:text-cyan-400">{{ $countByKategori['minuman'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <!-- Search and Filter Section -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <form method="GET" action="{{ route('menu.index') }}" class="flex flex-col lg:flex-row gap-4 items-end">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Menu</label>
                            <div class="relative">
                                <input type="text" id="search" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan nama menu atau resep..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Kategori Filter -->
                        <div class="w-full sm:w-48">
                            <label for="filter_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Kategori</label>
                            <div class="relative">
                                <select id="filter_kategori" name="filter_kategori"
                                    class="appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg pl-3 pr-8 py-2 text-sm text-gray-700 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 cursor-pointer"
                                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;">
                                    <option value="all" {{ request('filter_kategori', 'all') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                                    <option value="makanan" {{ request('filter_kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="minuman" {{ request('filter_kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                </select>
                                {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Per Page Selector -->
                        <div class="w-full sm:w-40">
                            <label for="per_page" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Per Halaman</label>
                            <div class="relative">
                                <select name="per_page" id="per_page"
                                    class="appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg pl-3 pr-8 py-2 text-sm text-gray-700 dark:text-gray-100 hover:border-gray-400 dark:hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 cursor-pointer"
                                    style="-webkit-appearance: none; -moz-appearance: none; appearance: none;"
                                    onchange="updatePerPage(this.value)">
                                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div> --}}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 flex-wrap">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            @if(request('search') || request('filter_kategori', 'all') !== 'all')
                                <a href="{{ route('menu.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                            <a href="{{ route('menu.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Menu
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Menu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Resep</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($menus as $menu)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $menu->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($menu->gambar)
                                        <img src="{{ asset('storage/' . $menu->gambar) }}"
                                             alt="{{ $menu->nama }}"
                                             class="w-16 h-16 object-cover rounded-lg border border-gray-200 dark:border-gray-600">
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $menu->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($menu->kategori == 'minuman') bg-cyan-100 dark:bg-cyan-900/30 text-cyan-800 dark:text-cyan-300
                                        @else bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300
                                        @endif">
                                        {{ ucfirst($menu->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $menu->formatted_harga }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-gray-100 max-w-xs truncate">{{ $menu->resep }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('menu.show', $menu) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-blue-700 dark:text-blue-300 bg-blue-100 dark:bg-blue-900/30 hover:bg-blue-200 dark:hover:bg-blue-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat
                                        </a>
                                        <a href="{{ route('menu.edit', $menu) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-yellow-700 dark:text-yellow-300 bg-yellow-100 dark:bg-yellow-900/30 hover:bg-yellow-200 dark:hover:bg-yellow-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('menu.destroy', $menu) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-xs leading-4 font-medium rounded-md text-red-700 dark:text-red-300 bg-red-100 dark:bg-red-900/30 hover:bg-red-200 dark:hover:bg-red-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
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
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">Tidak ada data menu</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Silakan tambah menu baru untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($menus->hasPages())
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <!-- Mobile Pagination -->
                        <div class="flex-1 flex justify-between items-center sm:hidden">
                            <div class="text-sm text-gray-700">
                                <span class="font-medium">{{ $menus->currentPage() }}</span>
                                dari
                                <span class="font-medium">{{ $menus->lastPage() }}</span>
                                halaman
                            </div>
                            <div class="flex space-x-1">
                                @if ($menus->onFirstPage())
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&lt;</span>
                                @else
                                    <a href="{{ $menus->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&lt;</a>
                                @endif

                                @if ($menus->hasMorePages())
                                    <a href="{{ $menus->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&gt;</a>
                                @else
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&gt;</span>
                                @endif
                            </div>
                        </div>

                        <!-- Desktop Pagination -->
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $menus->firstItem() ?? 0 }}</span>
                                    sampai
                                    <span class="font-medium">{{ $menus->lastItem() ?? 0 }}</span>
                                    dari
                                    <span class="font-medium">{{ $menus->total() }}</span>
                                    hasil
                                </p>
                            </div>
                            <div>
                                <nav class="flex items-center space-x-1" aria-label="Pagination">
                                    {{-- First Page --}}
                                    @if ($menus->currentPage() > 1)
                                        <a href="{{ $menus->url(1) }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&lt;&lt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&lt;&lt;</span>
                                    @endif

                                    {{-- Previous Page --}}
                                    @if ($menus->onFirstPage())
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&lt;</span>
                                    @else
                                        <a href="{{ $menus->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&lt;</a>
                                    @endif

                                    {{-- Current Page Info --}}
                                    <span class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-300 rounded-md">
                                        {{ $menus->currentPage() }} / {{ $menus->lastPage() }}
                                    </span>

                                    {{-- Next Page --}}
                                    @if ($menus->hasMorePages())
                                        <a href="{{ $menus->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&gt;</span>
                                    @endif

                                    {{-- Last Page --}}
                                    @if ($menus->currentPage() < $menus->lastPage())
                                        <a href="{{ $menus->url($menus->lastPage()) }}" class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">&gt;&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-md">&gt;&gt;</span>
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
