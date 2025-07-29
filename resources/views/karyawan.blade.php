<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-gray-600">Anda login sebagai: <span class="font-semibold text-green-600">{{ Auth::user()->getRoleNames()->first() }}</span></p>

                        @if(Auth::user()->karyawan)
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-800 mb-2">Informasi Karyawan:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div><strong>Nama:</strong> {{ Auth::user()->karyawan->nama }}</div>
                                <div><strong>Umur:</strong> {{ Auth::user()->karyawan->umur }} tahun</div>
                                <div><strong>Jenis Kelamin:</strong> {{ Auth::user()->karyawan->jenis_kelamin }}</div>
                                <div><strong>Posisi:</strong> {{ ucfirst(Auth::user()->karyawan->posisi) }}</div>
                                <div class="md:col-span-2"><strong>Alamat:</strong> {{ Auth::user()->karyawan->alamat }}</div>
                                <div><strong>Gaji:</strong> {{ Auth::user()->karyawan->formatted_gaji }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Absensi Card -->
                        <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800">Absensi Hari Ini</h4>
                                    <p class="text-green-600 font-medium">Belum Absen</p>
                                </div>
                            </div>
                        </div>

                        <!-- Jadwal Kerja Card -->
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800">Jam Kerja</h4>
                                    <p class="text-blue-600 font-medium">08:00 - 17:00</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tugas Card -->
                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800">Tugas Hari Ini</h4>
                                    <p class="text-yellow-600 font-medium">0 Tugas</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Menu Karyawan</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <a href="/absensi" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-800">Absensi</span>
                                </a>

                                <a href="#" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-800">Jadwal Kerja</span>
                                </a>

                                <a href="#" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                                    <svg class="w-8 h-8 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                    <span class="font-medium text-gray-800">Tugas</span>
                                </a>

                                <a href="#" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                    <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium text-gray-800">Profil</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pengumuman -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Pengumuman</h3>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            <strong>Selamat datang di sistem Cafe!</strong><br>
                                            Jangan lupa untuk melakukan absensi setiap hari dan menyelesaikan tugas yang diberikan dengan baik.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
