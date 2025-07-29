<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informasi Personal</h3>

                        <div class="space-y-4">
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Nama:</span>
                                <span class="font-semibold">{{ $karyawan->nama }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Email:</span>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Posisi:</span>
                                <span class="capitalize">{{ $karyawan->posisi }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">No. Telepon:</span>
                                <span>{{ $karyawan->no_telepon }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Alamat:</span>
                                <span>{{ $karyawan->alamat }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Gaji:</span>
                                <span>Rp {{ number_format($karyawan->gaji, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-32 text-gray-600 dark:text-gray-400">Status:</span>
                                <span class="capitalize">{{ $karyawan->status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('karyawan.dashboard') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Kembali ke Dashboard
                        </a>
                        <a href="{{ route('karyawan.riwayat') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                            Lihat Riwayat Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
