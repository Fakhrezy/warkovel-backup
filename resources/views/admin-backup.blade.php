<x-admin-layout>
    <x-slot name="header">
        Dashboard Admin
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow rounded-lg mb-6">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-gray-600">Anda login sebagai: <span class="font-semibold text-blue-600">{{ Auth::user()->getRoleNames()->first() }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Stats Cards -->
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
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

                        <div class="bg-green-50 p-6 rounded-lg border border-green-200">
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

                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
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

                        <div class="bg-purple-50 p-6 rounded-lg border border-purple-200">
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
                    <!-- Data Karyawan Ringkasan -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-800">Data Karyawan Terbaru</h3>
                            <a href="{{ route('karyawan.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Umur</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Gaji</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach(\App\Models\Karyawan::with('user')->latest()->take(5)->get() as $karyawan)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $karyawan->nama }}</div>
                                                @if($karyawan->user)
                                                <div class="text-xs text-gray-500">{{ $karyawan->user->email }}</div>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($karyawan->posisi == 'admin') bg-red-100 text-red-800
                                                    @elseif($karyawan->posisi == 'barista') bg-yellow-100 text-yellow-800
                                                    @elseif($karyawan->posisi == 'kasir') bg-green-100 text-green-800
                                                    @else bg-blue-100 text-blue-800
                                                    @endif">
                                                    {{ ucfirst($karyawan->posisi) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $karyawan->umur }} tahun</td>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $karyawan->formatted_gaji }}</td>
                                            <td class="px-4 py-3">
                                                @if($karyawan->status == 'aktif')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Aktif
                                                </span>
                                                @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
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
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-500 text-center py-8">Belum ada aktivitas terbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
