<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Absensi Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="mb-2 text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Posisi: <span class="font-semibold text-blue-600">{{ Auth::user()->karyawan->posisi ?? 'Staff' }}</span> |
                                Status: <span class="font-semibold text-green-600">{{ Auth::user()->karyawan->status ?? 'Aktif' }}</span>
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-semibold" id="current-time"></div>
                            <div class="text-sm text-gray-500" id="current-date"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded">
                    <div class="flex">
                        <svg class="flex-shrink-0 w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 py-3 mb-6 text-red-700 bg-red-100 border border-red-400 rounded">
                    <div class="flex">
                        <svg class="flex-shrink-0 w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Absensi Form -->
                <div class="lg:col-span-2">
                    <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg min-h-64">
                        <div class="p-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Absensi Hari Ini</h3>

                            <!-- Status Absensi Hari Ini -->
                            @if($absensiHariIni)
                                <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                                    <h4 class="mb-2 font-semibold text-blue-800 dark:text-blue-200">Status Absensi Hari Ini</h4>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">Waktu Masuk:</span>
                                            <div class="font-semibold text-green-600">
                                                {{ $absensiHariIni->jam_masuk ? \Carbon\Carbon::parse($absensiHariIni->jam_masuk)->format('H:i:s') : '-' }}
                                            </div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600 dark:text-gray-400">Waktu Keluar:</span>
                                            <div class="font-semibold {{ $absensiHariIni->jam_keluar ? 'text-red-600' : 'text-gray-400' }}">
                                                {{ $absensiHariIni->jam_keluar ? \Carbon\Carbon::parse($absensiHariIni->jam_keluar)->format('H:i:s') : 'Belum absen keluar' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Form Absensi -->
                            <form method="POST" action="{{ route('karyawan.absensi') }}" class="space-y-4">
                                @csrf

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <!-- Absen Masuk -->
                                    <button type="submit" name="action" value="masuk"
                                            class="flex items-center justify-center w-full px-6 py-4 font-semibold text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700 disabled:bg-gray-400"
                                            {{ $absensiHariIni && $absensiHariIni->jam_masuk ? 'disabled' : '' }}>
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ $absensiHariIni && $absensiHariIni->jam_masuk ? 'Sudah Absen Masuk' : 'Absen Masuk' }}
                                    </button>

                                    <!-- Absen Keluar -->
                                    <button type="submit" name="action" value="keluar"
                                            class="flex items-center justify-center w-full px-6 py-4 font-semibold text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700 disabled:bg-gray-400"
                                            {{ !$absensiHariIni || !$absensiHariIni->jam_masuk || $absensiHariIni->jam_keluar ? 'disabled' : '' }}>
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        @if(!$absensiHariIni || !$absensiHariIni->jam_masuk)
                                            Absen Masuk Dulu
                                        @elseif($absensiHariIni->jam_keluar)
                                            Sudah Absen Keluar
                                        @else
                                            Absen Keluar
                                        @endif
                                    </button>
                                </div>

                                <div class="text-sm text-center text-gray-500 dark:text-gray-400">
                                    <p>Pastikan Anda berada di lokasi kerja saat melakukan absensi</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Statistik & Info -->
                <div class="space-y-6">
                    <!-- Statistik Bulan Ini -->
                    <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg min-h-64">
                        <div class="p-6">
                            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Statistik Bulan Ini</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Total Kehadiran:</span>
                                    <span class="font-semibold text-green-600">{{ $statistik['total_hadir'] }} hari</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Tidak Hadir:</span>
                                    <span class="font-semibold text-red-600">{{ $statistik['total_tidak_hadir'] }} hari</span>
                                </div>
                                <hr class="border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Persentase Hadir:</span>
                                    <span class="font-semibold text-blue-600">{{ $statistik['persentase_hadir'] }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Absensi Minggu Ini -->
            <div class="mt-6">
                <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Riwayat Absensi Minggu Ini</h3>

                        @if($riwayatMingguIni->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Tanggal</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Jam Masuk</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Jam Keluar</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Status</th>
                                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Total Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @foreach($riwayatMingguIni as $absensi)
                                            <tr>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}
                                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('l') }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                                    {{ $absensi->jam_masuk ? \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                                    {{ $absensi->jam_keluar ? \Carbon\Carbon::parse($absensi->jam_keluar)->format('H:i') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $status = 'Hadir';
                                                        $statusClass = 'bg-green-100 text-green-800';

                                                        if (!$absensi->jam_masuk) {
                                                            $status = 'Tidak Hadir';
                                                            $statusClass = 'bg-red-100 text-red-800';
                                                        }
                                                    @endphp
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                        {{ $status }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                                    @if($absensi->jam_masuk && $absensi->jam_keluar)
                                                        @php
                                                            try {
                                                                $tanggalBase = \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d');
                                                                $masuk = \Carbon\Carbon::parse($tanggalBase . ' ' . $absensi->jam_masuk);
                                                                $keluar = \Carbon\Carbon::parse($tanggalBase . ' ' . $absensi->jam_keluar);
                                                                $totalJam = $keluar->diff($masuk);
                                                                echo $totalJam->format('%H:%I');
                                                            } catch (Exception $e) {
                                                                echo '-';
                                                            }
                                                        @endphp
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-8 text-center text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p class="mt-2">Belum ada riwayat absensi minggu ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update waktu real-time
        function updateTime() {
            const now = new Date();
            // Format time untuk timezone Indonesia
            const timeString = now.toLocaleTimeString('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour12: false
            });
            const dateString = now.toLocaleDateString('id-ID', {
                timeZone: 'Asia/Jakarta',
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            document.getElementById('current-time').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
        }

        // Update setiap detik
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</x-app-layout>
