<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>
                    <p class="text-gray-600">Anda login sebagai: <span class="font-semibold text-blue-600">{{ Auth::user()->getRoleNames()->first() }}</span></p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Karyawan -->
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Total Karyawan</h4>
                            <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Karyawan::count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penjualan Hari Ini -->
                <div class="bg-green-50 p-6 rounded-lg border border-green-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Penjualan Hari Ini</h4>
                            <p class="text-2xl font-bold text-green-600">Rp 0</p>
                        </div>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Total Produk</h4>
                            <p class="text-2xl font-bold text-yellow-600">0</p>
                        </div>
                    </div>
                </div>

                <!-- Total Pesanan -->
                <div class="bg-purple-50 p-6 rounded-lg border border-purple-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-500 bg-opacity-20">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800">Total Pesanan</h4>
                            <p class="text-2xl font-bold text-purple-600">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Data Karyawan Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Data Karyawan Terbaru</h3>
                            <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-600 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Lihat Semua
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posisi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse(\App\Models\Karyawan::with('user')->latest()->take(5)->get() as $karyawan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $karyawan->nama }}</div>
                                            @if($karyawan->user)
                                            <div class="text-sm text-gray-500">{{ $karyawan->user->email }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($karyawan->posisi == 'admin') bg-red-100 text-red-800
                                                @elseif($karyawan->posisi == 'barista') bg-yellow-100 text-yellow-800
                                                @elseif($karyawan->posisi == 'kasir') bg-green-100 text-green-800
                                                @else bg-blue-100 text-blue-800
                                                @endif">
                                                {{ ucfirst($karyawan->posisi) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $karyawan->umur }} tahun</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $karyawan->formatted_gaji }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($karyawan->status == 'aktif')
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                            @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Tidak Aktif
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada data karyawan
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Activity & Quick Stats -->
                <div class="space-y-6">
                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('karyawan.create') }}" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-800 group-hover:text-blue-800">Tambah Karyawan</span>
                            </a>

                            <a href="{{ route('karyawan.index') }}" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                                <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-800 group-hover:text-green-800">Kelola Karyawan</span>
                            </a>

                            <a href="#" class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors group">
                                <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-800 group-hover:text-purple-800">Laporan</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                        </div>
                        <div class="p-6">
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">Belum ada aktivitas terbaru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
