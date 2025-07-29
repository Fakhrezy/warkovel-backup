<x-admin-layout>
    <x-slot name="header">
        Kelola Kehadiran Karyawan
    </x-slot>

    <div class="p-4 sm:p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Header Section dengan Action Button -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Data Kehadiran</h2>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola data kehadiran karyawan cafe</p>
                            <div class="flex items-center mt-2">
                                <svg class="w-4 h-4 text-blue-500 dark:text-blue-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs text-blue-600 dark:text-blue-400 font-medium"> Tahun {{ $currentYear }}</span>
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('kehadiran.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Kehadiran
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-blue-500 bg-opacity-20 dark:bg-blue-500/30">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Total</h3>
                            <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $totalKehadiran }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-4 rounded-lg border border-green-200 dark:border-green-800 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-green-500 bg-opacity-20 dark:bg-green-500/30">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Hadir</h3>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $countByStatus['hadir'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 p-4 rounded-lg border border-red-200 dark:border-red-800 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-red-500 bg-opacity-20 dark:bg-red-500/30">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Tidak Hadir</h3>
                            <p class="text-xl font-bold text-red-600 dark:text-red-400">{{ $countByStatus['tidak_hadir'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 p-4 rounded-lg border border-indigo-200 dark:border-indigo-800 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center">
                        <div class="p-2 rounded-full bg-indigo-500 bg-opacity-20 dark:bg-indigo-500/30">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Izin/Sakit</h3>
                            <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ ($countByStatus['izin'] ?? 0) + ($countByStatus['sakit'] ?? 0) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <!-- Search and Filter Section -->
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <form method="GET" action="{{ route('kehadiran.index') }}" class="space-y-4">
                        <!-- Search Row -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Search Input -->
                            <div class="flex-1">
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cari Karyawan</label>
                                <div class="relative">
                                    <input type="text" id="search" name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari berdasarkan nama karyawan..."
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="w-full sm:w-48">
                                <label for="filter_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select id="filter_status" name="filter_status" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700 dark:text-gray-100">
                                    <option value="all" {{ request('filter_status', 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="hadir" {{ request('filter_status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="tidak_hadir" {{ request('filter_status') == 'tidak_hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                    <option value="izin" {{ request('filter_status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ request('filter_status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filter Row -->
                        <div class="flex flex-col sm:flex-row gap-4 items-end">
                            <!-- Month Filter -->
                            <div class="w-full sm:w-40">
                                <label for="filter_bulan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                                <select name="filter_bulan" id="filter_bulan" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700 dark:text-gray-100">
                                    <option value="" {{ !request('filter_bulan') ? 'selected' : '' }}>Semua Bulan</option>
                                    @foreach($availableMonths as $month)
                                        <option value="{{ $month['value'] }}" {{ request('filter_bulan') == $month['value'] ? 'selected' : '' }}>
                                            {{ $month['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year Display (Current Year Only) -->
                            <div class="w-full sm:w-32">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                                <div class="w-full bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm text-gray-600 dark:text-gray-300">
                                    {{ $currentYear }}
                                </div>
                            </div>

                            <!-- Per Page -->
                            <div class="w-full sm:w-24">
                                <label for="per_page" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Per Hal.</label>
                                <select name="per_page" id="per_page" class="w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700 dark:text-gray-100" onchange="updatePerPage(this.value)">
                                    <option value="5" {{ request('per_page', 10) == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 flex-wrap">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Filter
                                </button>
                                @if(request('search') || request('filter_status', 'all') !== 'all')
                                    <a href="{{ route('kehadiran.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Hidden fields to preserve filters -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        <input type="hidden" name="filter_bulan" value="{{ $filterBulan }}">
                    </form>
                </div>
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Karyawan</th>
                                <th class="hidden md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jam Kerja</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($kehadirans as $kehadiran)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <!-- Tanggal -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $kehadiran->formatted_tanggal }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 md:hidden">
                                        {{ $kehadiran->jam_masuk ? $kehadiran->jam_masuk->format('H:i') : '-' }} -
                                        {{ $kehadiran->jam_keluar ? $kehadiran->jam_keluar->format('H:i') : '-' }}
                                    </div>
                                </td>

                                <!-- Karyawan & Posisi -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $kehadiran->karyawan->nama }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    @if($kehadiran->karyawan->posisi == 'barista') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300
                                                    @elseif($kehadiran->karyawan->posisi == 'kasir') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                                                    @else bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300
                                                    @endif">
                                                    {{ ucfirst($kehadiran->karyawan->posisi) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Jam Kerja (Hidden on mobile) -->
                                <td class="hidden md:table-cell px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-gray-100">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-green-600 dark:text-green-400">{{ $kehadiran->jam_masuk ? $kehadiran->jam_masuk->format('H:i') : '-' }}</span>
                                            <span class="text-gray-400 dark:text-gray-500">→</span>
                                            <span class="text-red-600 dark:text-red-400">{{ $kehadiran->jam_keluar ? $kehadiran->jam_keluar->format('H:i') : '-' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($kehadiran->status_kehadiran == 'hadir') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                                        @elseif($kehadiran->status_kehadiran == 'tidak_hadir') bg-rose-100 dark:bg-rose-900/30 text-rose-800 dark:text-rose-300
                                        @elseif($kehadiran->status_kehadiran == 'izin') bg-sky-100 dark:bg-sky-900/30 text-sky-800 dark:text-sky-300
                                        @else bg-slate-100 dark:bg-slate-900/30 text-slate-800 dark:text-slate-300
                                        @endif">
                                        @if($kehadiran->status_kehadiran == 'hadir')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($kehadiran->status_kehadiran == 'tidak_hadir')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst(str_replace('_', ' ', $kehadiran->status_kehadiran)) }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-1 sm:space-x-2">
                                        <a href="{{ route('kehadiran.show', $kehadiran) }}"
                                           class="inline-flex items-center p-1.5 sm:px-2.5 sm:py-1.5 border border-transparent rounded-md text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-900/30 hover:bg-indigo-200 dark:hover:bg-indigo-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition duration-150"
                                           title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span class="hidden sm:ml-1 sm:inline">Detail</span>
                                        </a>
                                        <a href="{{ route('kehadiran.edit', $kehadiran) }}"
                                           class="inline-flex items-center p-1.5 sm:px-2.5 sm:py-1.5 border border-transparent rounded-md text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/30 hover:bg-amber-200 dark:hover:bg-amber-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800 transition duration-150"
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span class="hidden sm:ml-1 sm:inline">Edit</span>
                                        </a>
                                        <form action="{{ route('kehadiran.destroy', $kehadiran) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kehadiran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center p-1.5 sm:px-2.5 sm:py-1.5 border border-transparent rounded-md text-rose-600 dark:text-rose-400 bg-rose-100 dark:bg-rose-900/30 hover:bg-rose-200 dark:hover:bg-rose-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 dark:focus:ring-offset-gray-800 transition duration-150"
                                                    title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                <span class="hidden sm:ml-1 sm:inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 sm:px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gray-50 dark:bg-gray-700 mb-6">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Belum ada data kehadiran</h3>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 max-w-sm">
                                            Data kehadiran karyawan akan ditampilkan disini. Mulai dengan menambahkan data kehadiran pertama.
                                        </p>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <a href="{{ route('kehadiran.create') }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Tambah Kehadiran
                                            </a>
                                            <a href="{{ route('karyawan.index') }}"
                                               class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                Kelola Karyawan
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($kehadirans->hasPages())
                <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 flex items-center justify-between">
                        <!-- Mobile Pagination -->
                        <div class="flex-1 flex justify-between items-center sm:hidden">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <span class="font-medium">{{ $kehadirans->currentPage() }}</span>
                                dari
                                <span class="font-medium">{{ $kehadirans->lastPage() }}</span>
                                halaman
                            </div>
                            <div class="flex space-x-1">
                                @if ($kehadirans->onFirstPage())
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&lt;</span>
                                @else
                                    <a href="{{ $kehadirans->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&lt;</a>
                                @endif

                                @if ($kehadirans->hasMorePages())
                                    <a href="{{ $kehadirans->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&gt;</a>
                                @else
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&gt;</span>
                                @endif
                            </div>
                        </div>

                        <!-- Desktop Pagination -->
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    Menampilkan
                                    <span class="font-medium">{{ $kehadirans->firstItem() ?? 0 }}</span>
                                    sampai
                                    <span class="font-medium">{{ $kehadirans->lastItem() ?? 0 }}</span>
                                    dari
                                    <span class="font-medium">{{ $kehadirans->total() }}</span>
                                    hasil
                                </p>
                            </div>
                            <div>
                                <nav class="flex items-center space-x-1" aria-label="Pagination">
                                    {{-- First Page --}}
                                    @if ($kehadirans->currentPage() > 1)
                                        <a href="{{ $kehadirans->url(1) }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&lt;&lt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&lt;&lt;</span>
                                    @endif

                                    {{-- Previous Page --}}
                                    @if ($kehadirans->onFirstPage())
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&lt;</span>
                                    @else
                                        <a href="{{ $kehadirans->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&lt;</a>
                                    @endif

                                    {{-- Current Page Info --}}
                                    <span class="px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 border border-blue-300 dark:border-blue-600 rounded-md">
                                        {{ $kehadirans->currentPage() }} / {{ $kehadirans->lastPage() }}
                                    </span>

                                    {{-- Next Page --}}
                                    @if ($kehadirans->hasMorePages())
                                        <a href="{{ $kehadirans->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&gt;</span>
                                    @endif

                                    {{-- Last Page --}}
                                    @if ($kehadirans->currentPage() < $kehadirans->lastPage())
                                        <a href="{{ $kehadirans->url($kehadirans->lastPage()) }}" class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">&gt;&gt;</a>
                                    @else
                                        <span class="px-3 py-2 text-sm font-medium text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 cursor-not-allowed rounded-md">&gt;&gt;</span>
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
