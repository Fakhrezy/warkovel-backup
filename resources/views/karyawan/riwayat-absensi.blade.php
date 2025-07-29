<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Riwayat Kehadiran</h3>

                        @if($riwayat->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jam Masuk</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jam Keluar</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Jam</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($riwayat as $absensi)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}
                                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('l') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $absensi->jam_masuk ? \Carbon\Carbon::parse($absensi->jam_masuk)->format('H:i') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
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
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
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

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $riwayat->links() }}
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada data absensi</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai melakukan absensi untuk melihat riwayat.</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('karyawan.dashboard') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Kembali ke Dashboard
                        </a>
                        <a href="{{ route('karyawan.profile') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            Lihat Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
